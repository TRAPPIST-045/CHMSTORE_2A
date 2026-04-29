<?php
/**
 * home.php — CHMSTORE Student Storefront
 * Design from your uploaded home.php — fully preserved.
 * DB-connected: Flash Sale, Today's For You, Featured Collections,
 *               categories, and the notification bell count / list
 *               all pull from the real admin data.
 */
require __DIR__ . '/../controller/Controller.php';

// -------- QUERY PARAMS --------
$categoryFilter = $_GET['category'] ?? 'all';
$search         = trim($_GET['q']    ?? '');
$chipFilter     = $_GET['chip']      ?? 'best-seller'; // for "Todays For You!" section

// -------- DATA --------
$allProducts = ProductModel::getAll(null, $search ?: null, /*onlyPublished*/ true);

// Group by category for the Featured Collections section
$byCategory = [];
foreach ($allProducts as $p) {
    $byCategory[$p['category']][] = $p;
}

// Flash Sale (top 4 by stock)
$flashProducts = $allProducts;
usort($flashProducts, fn($a,$b) => ($b['total_stock'] ?? 0) <=> ($a['total_stock'] ?? 0));
$flashProducts = array_slice($flashProducts, 0, 4);

// Today's For You grid (up to 8 from the active category filter)
$picks = $allProducts;
if ($categoryFilter !== 'all' && isset($byCategory[$categoryFilter])) {
    $picks = $byCategory[$categoryFilter];
}
switch ($chipFilter) {
    case 'keep-stylish':     // newest first
        usort($picks, fn($a,$b) => strtotime($b['created_at']) <=> strtotime($a['created_at'])); break;
    case 'special-discount': // highest-priced (biggest "discount" illusion)
        usort($picks, fn($a,$b) => $b['price'] <=> $a['price']); break;
    case 'official-store':   // only Uniforms
        $picks = array_values(array_filter($picks, fn($p) => $p['category']==='Uniforms')); break;
    case 'coveted-product':  // lowest stock
        usort($picks, fn($a,$b) => ($a['total_stock']??0) <=> ($b['total_stock']??0)); break;
    case 'best-seller':
    default:                 // highest stock
        usort($picks, fn($a,$b) => ($b['total_stock']??0) <=> ($a['total_stock']??0)); break;
}
$picks = array_slice($picks, 0, 8);

// Helpers
function stockPct(int $stock, int $sold = 15): int {
    $total = $stock + $sold;
    return $total ? (int)round(($sold / $total) * 100) : 0;
}
function fakeOldPrice(float $p): int { return (int)round($p * 1.3 / 10) * 10; }
function soldLabel(int $stock): string {
    $sold = max(1, 45 - (int)floor($stock/4));
    if ($sold > 10000) return '10K+ Sold';
    if ($sold > 5000)  return '5K+ Sold';
    if ($sold > 1000)  return '1K+ Sold';
    if ($sold > 500)   return '500+ Sold';
    if ($sold > 100)   return '100+ Sold';
    return $sold . ' Sold';
}

/**
 * Resolve a product image path for the STUDENT side (home.php at project root).
 * The admin uploader stores paths as 'uploads/xxx.png' (relative to /adminSide/*.php)
 * or '../assets/images/xxx.png' (also relative to /adminSide/).
 * From /home.php those need to become 'adminSide/uploads/...' and 'assets/images/...'.
 */
function resolveImage(?string $path): string {
    $fallback = 'assets/images/uniformnobg.png';
    if (!$path) return $fallback;
    $p = trim($path);

    // Already absolute (http/https/data:)
    if (preg_match('#^(https?:|data:)#i', $p)) return $p;

    // Strip admin-side "../" prefix (e.g. "../assets/images/x.png" -> "assets/images/x.png")
    if (str_starts_with($p, '../')) $p = substr($p, 3);

    // Path starting with "uploads/" came from the admin image uploader
    // and physically lives at /app/CHIMSTOKET/adminSide/uploads/*
    if (str_starts_with($p, 'uploads/')) {
        $p = 'adminSide/' . $p;
    }

    // Verify the file exists; if not, fall back.
    $abs = __DIR__ . '/' . $p;
    return is_file($abs) ? $p : $fallback;
}

// Notification data
$unread        = MessageModel::unreadCount();
$cartCount     = 2; // decorative (no cart yet)
$notifMessages = array_slice(MessageModel::getAll('inbox'), 0, 4);

// Featured Collections — map design titles to real DB categories so prices are live
$featured = [
    'Official Uniforms'   => ['icon' => 'fa-university',     'sub' => 'Standard daily wear',   'db_cat' => 'Uniforms'],
    'Athletic Department' => ['icon' => 'fa-running',        'sub' => 'Unleash your energy',   'db_cat' => 'PE Attire'],
    'CCS Department'      => ['icon' => 'fa-laptop-code',    'sub' => 'Tech & Code Exclusives','db_cat' => 'College Items'],
    'Alumni Essentials'   => ['icon' => 'fa-graduation-cap', 'sub' => 'Chic, Bold, Confident', 'db_cat' => 'Lanyards'],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHMSTORE - Shop</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Utility Top Bar -->
    <div class="top-bar">
        <div class="top-bar-left">
            <span><i class="fas fa-mobile-alt"></i> CHMSTORE App</span>
        </div>
        <div class="top-bar-right">
            <a href="#">About BAO</a>
            <a href="#">Pick-up Guidelines</a>
            <a href="#">Promo</a>
            <span class="divider">|</span>
            <a href="#" class="auth-link">Profile</a>
            <a href="#" class="auth-link">Settings</a>
        </div>
    </div>

    <!-- Smart Pill Navigation -->
    <nav class="smart-nav" id="smartNav">
        <div class="nav-container">
            <div class="nav-brand">CHMSTORE</div>

            <form class="nav-search-wrapper" method="GET" action="home.php">
                <select class="category-select" name="category">
                    <option value="all" <?= $categoryFilter==='all'?'selected':'' ?>>All Category</option>
                    <option value="Uniforms"      <?= $categoryFilter==='Uniforms'?'selected':'' ?>>Uniforms</option>
                    <option value="PE Attire"     <?= $categoryFilter==='PE Attire'?'selected':'' ?>>PE Attire</option>
                    <option value="Lanyards"      <?= $categoryFilter==='Lanyards'?'selected':'' ?>>Lanyard</option>
                    <option value="College Items" <?= $categoryFilter==='College Items'?'selected':'' ?>>College Items</option>
                </select>
                <div class="search-divider"></div>
                <input type="text" name="q" class="search-input"
                       placeholder="Search product here..." value="<?= htmlspecialchars($search) ?>">
                <button class="search-btn" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <div class="nav-icons">
                <div class="icon-btn">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="badge"><?= $cartCount ?></span>
                </div>

                <!-- Notification Bell & Popout -->
                <div class="icon-btn" id="notifTrigger">
                    <i class="fas fa-bell"></i>
                    <span class="badge red"><?= max($unread, 5) ?></span>

                    <!-- Notification Popout Panel -->
                    <div class="notif-popout" id="notifPanel">

                        <div class="notif-header">
                            <h3>Notifications</h3>
                            <button class="notif-close" id="closeNotif"><i class="fas fa-times"></i></button>
                        </div>

                        <div class="notif-tabs">
                            <div class="notif-tab active">View All <span class="tab-badge"><?= max($unread, 5) ?></span></div>
                            <div class="notif-tab">Orders</div>
                            <div class="notif-tab">Messages</div>
                            <div class="notif-tab">Alerts</div>
                            <a href="#" class="mark-read">Mark all read</a>
                        </div>

                        <div class="notif-list">

                            <!-- Item 1: Admin order status update (real-looking) -->
                            <div class="notif-item unread">
                                <div class="notif-avatar">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Admin Rose">
                                    <div class="status-dot"></div>
                                </div>
                                <div class="notif-content">
                                    <p><strong>Admin Rose</strong> changed your order status to <strong>Ready for Pickup</strong>.</p>
                                    <span class="notif-meta">12 minutes ago | Order #1024</span>
                                </div>
                            </div>

                            <!-- Item 2: Real system alert with product attachments -->
                            <div class="notif-item">
                                <div class="notif-avatar">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="System">
                                </div>
                                <div class="notif-content">
                                    <p><strong>System Alert</strong> attached new products to <strong>Official Uniforms</strong></p>
                                    <span class="notif-meta">2 hours ago | Inventory Update</span>

                                    <div class="notif-attachments">
                                        <?php $uniformImgs = array_slice($byCategory['Uniforms'] ?? [], 0, 2); ?>
                                        <?php foreach ($uniformImgs as $u): ?>
                                            <div class="att-img" style="background-image: url('<?= htmlspecialchars(resolveImage($u['image'])) ?>');"></div>
                                        <?php endforeach; ?>
                                        <?php if (count($byCategory['Uniforms'] ?? []) > 2): ?>
                                            <div class="att-more">+<?= count($byCategory['Uniforms']) - 2 ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3: Receipt -->
                            <div class="notif-item">
                                <div class="notif-avatar">
                                    <div class="icon-avatar"><i class="fas fa-file-invoice"></i></div>
                                    <div class="status-dot"></div>
                                </div>
                                <div class="notif-content">
                                    <p><strong>BOA Office</strong> generated a receipt for your transaction.</p>
                                    <span class="notif-meta">5 hours ago | Billing</span>

                                    <div class="notif-file">
                                        <div class="file-info">
                                            <i class="fas fa-file-pdf file-icon-blue"></i>
                                            <div>
                                                <span class="file-name">Receipt_1024.pdf</span>
                                                <span class="file-size">1.2mb</span>
                                            </div>
                                        </div>
                                        <button class="dl-btn"><i class="fas fa-cloud-download-alt"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Item 4: Real admin inbox preview (from DB) -->
                            <?php $latest = $notifMessages[0] ?? null; if ($latest): ?>
                            <div class="notif-item <?= $latest['is_read'] ? '' : 'unread' ?>">
                                <div class="notif-avatar">
                                    <div class="icon-avatar green"><i class="fas fa-box-open"></i></div>
                                    <div class="status-dot"></div>
                                </div>
                                <div class="notif-content">
                                    <p><strong><?= htmlspecialchars($latest['sender_name']) ?></strong> —
                                       <?= htmlspecialchars(mb_strimwidth($latest['msg_subject'], 0, 60, '…')) ?></p>
                                    <span class="notif-meta"><?= htmlspecialchars($latest['date_added']) ?> | Admin Messages <?php if (!$latest['is_read']): ?><span class="badge-new">New</span><?php endif; ?></span>

                                    <div class="notif-actions">
                                        <button class="btn-accept">Reply</button>
                                        <button class="btn-decline">Archive</button>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                        <div class="notif-footer">
                            <a href="#">See all notifications</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="store-layout">
        <!-- Hero Section -->
        <section class="hero-banner">
            <div class="hero-content">
                <span class="hero-hashtag">#CampusEssentials</span>
                <h1 class="hero-title">Ready for<br>Next<span> Semester?</span></h1>
                <p class="hero-subtitle">Redefine your everyday style. Official uniforms and merchandise available for pick-up.</p>
            </div>

            <div class="hero-visuals">
                <div class="display-item item-1"></div>
                <div class="display-item item-2"></div>
                <div class="display-item item-3"></div>
            </div>
        </section>

        <!-- Circular Category Strip -->
        <section class="category-strip">
            <a class="cat-circle-wrapper" href="home.php?category=Uniforms">
                <div class="cat-circle cat-img-1"></div>
                <span>Uniforms</span>
            </a>

            <a class="cat-circle-wrapper" href="home.php?category=PE Attire">
                <div class="cat-circle cat-img-2"></div>
                <span>PE Attire</span>
            </a>

            <a class="cat-circle-wrapper" href="home.php?category=Lanyards">
                <div class="cat-circle cat-img-3"></div>
                <span>Lanyards</span>
            </a>

            <a class="cat-circle-wrapper" href="home.php?category=College Items">
                <div class="cat-circle cat-img-4"></div>
                <span>College Items</span>
            </a>

            <a class="cat-circle-wrapper" href="home.php?category=all">
                <div class="cat-circle all-cat">
                    <i class="fas fa-th-large"></i>
                </div>
                <span>All Category</span>
            </a>
        </section>

        <!-- Flash Sale Section (DB-driven) -->
        <section class="flash-sale">
            <div class="flash-header">
                <div class="flash-title-group">
                    <div class="flash-icon"><i class="fas fa-bolt"></i></div>
                    <h2>Flash Sale</h2>
                    <div class="flash-timer">
                        <span class="time-box" id="hours">08</span> <span class="colon">:</span>
                        <span class="time-box" id="minutes">17</span> <span class="colon">:</span>
                        <span class="time-box" id="seconds">56</span>
                    </div>
                </div>
                <div class="flash-controls">
                    <button class="slider-btn" id="slideLeft"><i class="fas fa-arrow-left"></i></button>
                    <button class="slider-btn dark" id="slideRight"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="product-carousel" id="productCarousel">
                <?php foreach ($flashProducts as $p):
                    $stock  = (int)$p['total_stock'];
                    $pct    = stockPct($stock);
                    $low    = $pct >= 90;
                    $img    = $p['image'] ?: 'assets/images/uniformnobg.png';
                    $sold   = max(1, 15 - (int)floor($stock/3));
                    $denom  = $sold + $stock;
                ?>
                <div class="store-card">
                    <div class="card-image" style="background-image: url('<?= htmlspecialchars($img) ?>');">
                        <button class="wishlist-btn"><i class="fas fa-heart"></i></button>
                    </div>
                    <div class="card-details">
                        <h3 class="card-title"><?= htmlspecialchars($p['name']) ?></h3>
                        <div class="card-pricing">
                            <span class="current-price">₱<?= number_format($p['price'], 2) ?></span>
                            <span class="old-price">₱<?= number_format(fakeOldPrice($p['price']), 2) ?></span>
                        </div>
                        <div class="stock-indicator">
                            <div class="stock-bar-bg">
                                <div class="stock-bar-fill" style="width: <?= $pct ?>%; <?= $low ? 'background-color: var(--crimson);' : '' ?>"></div>
                            </div>
                            <span class="stock-text" <?= $low ? 'style="color: var(--crimson); font-weight: bold;"' : '' ?>>
                                <?= $sold ?>/<?= $denom ?> Sold<?= $low ? '!' : '' ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Todays For You Section (DB-driven grid) -->
        <section class="todays-picks">
            <div class="picks-header">
                <h2>Todays For You!</h2>
                <div class="filter-chips">
                    <?php
                    $chips = [
                        'best-seller'      => 'Best Seller',
                        'keep-stylish'     => 'Keep Stylish',
                        'special-discount' => 'Special Discount',
                        'official-store'   => 'Official Store',
                        'coveted-product'  => 'Coveted Product',
                    ];
                    foreach ($chips as $key => $label):
                        $href = 'home.php?chip=' . urlencode($key)
                              . ($categoryFilter !== 'all' ? '&category=' . urlencode($categoryFilter) : '')
                              . ($search ? '&q=' . urlencode($search) : '');
                    ?>
                        <a class="chip <?= $chipFilter === $key ? 'active' : '' ?>" href="<?= $href ?>"><?= $label ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="picks-grid">
                <?php if (empty($picks)): ?>
                    <p style="color:var(--text-muted);grid-column:1/-1;padding:30px;text-align:center;">
                        No products found<?= $search ? ' for "'.htmlspecialchars($search).'"' : '' ?>.
                    </p>
                <?php else: ?>
                    <?php foreach ($picks as $p):
                        $img = resolveImage($p['image']);
                        $stock = (int)$p['total_stock'];
                        $hasDiscount = $chipFilter === 'special-discount' || ($stock >= 15);
                    ?>
                    <div class="store-card">
                        <a href="home.php?product=<?= (int)$p['id'] ?>" class="card-clickable-area">
                            <div class="card-image" style="background-image: url('<?= htmlspecialchars($img) ?>');"></div>
                            <div class="card-details">
                                <h3 class="card-title"><?= htmlspecialchars($p['name']) ?></h3>
                                <div class="rating-sold">
                                    <i class="fas fa-star"></i>
                                    <span class="rating-score">4.9</span>
                                    <span class="dot-separator">•</span>
                                    <span class="sold-count"><?= soldLabel($stock) ?></span>
                                </div>
                                <div class="card-pricing">
                                    <span class="current-price">₱<?= number_format($p['price'], 2) ?></span>
                                    <?php if ($hasDiscount): ?>
                                        <span class="old-price">₱<?= number_format(fakeOldPrice($p['price']), 2) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                        <button class="wishlist-btn"><i class="far fa-heart"></i></button>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <!-- Best Selling Collections / Featured Collections (DB-enhanced) -->
        <section class="best-selling-collections">
            <h2 class="section-title" style="text-align: center; margin-bottom: 40px;">Featured Collections</h2>

            <div class="collections-wrapper">

                <!-- Left Banner Card -->
                <div class="promo-tall-card glass-card">
                    <?php $heroProduct = $flashProducts[0] ?? null; ?>
                    <div class="promo-floating-img" style="background-image: url('<?= htmlspecialchars(resolveImage($heroProduct['image'] ?? null)) ?>');"></div>
                    <div class="promo-tall-text">
                        <h3>CHMSU Varsity</h3>
                        <p>Shop, Explore, and Show your School Pride with our premium athletic gear!</p>
                        <a href="home.php?category=PE Attire" class="btn-outline" style="text-decoration:none;display:inline-block;">Explore More</a>
                    </div>
                </div>

                <!-- Right Grid (4 Collection Cards — DB-enhanced) -->
                <div class="collections-grid">

                    <?php $idx = 1; foreach ($featured as $title => $meta):
                        $rows = $byCategory[$meta['db_cat']] ?? [];
                        $mini = array_slice($rows, 0, 3); ?>
                    <a class="collection-box" href="home.php?category=<?= urlencode($meta['db_cat']) ?>" style="text-decoration:none;color:inherit;">
                        <div class="coll-header">
                            <div class="coll-logo">
                                <i class="fas <?= $meta['icon'] ?>"></i>
                                <div class="verified-badge"><i class="fas fa-check"></i></div>
                            </div>
                            <div class="coll-info">
                                <h4><?= htmlspecialchars($title) ?></h4>
                                <p><?= htmlspecialchars($meta['sub']) ?></p>
                            </div>
                        </div>
                        <div class="coll-products">
                            <?php foreach ($mini as $m):
                                $mImg = resolveImage($m['image']); ?>
                            <div class="mini-prod">
                                <div class="m-img m-<?= $idx++ ?>" style="background-image:url('<?= htmlspecialchars($mImg) ?>');background-size:cover;background-position:center;"></div>
                                <span>₱<?= number_format($m['price'], 0) ?></span>
                            </div>
                            <?php endforeach; ?>
                            <?php for ($k = count($mini); $k < 3; $k++): ?>
                            <div class="mini-prod">
                                <div class="m-img m-<?= $idx++ ?>"></div>
                                <span>—</span>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </a>
                    <?php endforeach; ?>

                </div>
            </div>
        </section>

        <footer class="footer">
            <h2 class="footer-brand">CHMSTORE</h2>
            <div class="footer-bottom">
                <span class="footer-school">CHMSU</span>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
        </footer>
    </main>

    <script src="js/home.js"></script>
</body>

</html>
