<?php
/**
 * php sql/seed.php  — resets and seeds the DB.
 */
require __DIR__ . '/../controller/Controller.php';
$pdo = Database::pdo();

$pdo->exec('SET FOREIGN_KEY_CHECKS=0');
foreach (['order_items','orders','product_variants','products','messages','students','users'] as $t) {
    $pdo->exec("TRUNCATE TABLE `$t`");
}
$pdo->exec('SET FOREIGN_KEY_CHECKS=1');

// Admin
$pdo->prepare('INSERT INTO users (username,password_hash,full_name,role) VALUES (?,?,?,?)')
    ->execute(['iamsuperadmin', password_hash('Admin@123',PASSWORD_DEFAULT), 'Admin Rose','admin']);
echo "[OK] admin iamsuperadmin / Admin@123\n";

// Students
$students = [
    ['2024-00042','Enna Reyes',       'iEnna.r@student.chmsu.edu.ph', 'BSIT','2nd Year'],
    ['2024-00038','Dexter Argan',     'dexter.a@student.chmsu.edu.ph','BSIT','2nd Year'],
    ['2024-00040','Carlo Dimaculangan','carlo.d@student.chmsu.edu.ph','BSIT','1st Year'],
    ['2024-00035','Richard Popye',    'richard.p@student.chmsu.edu.ph','BSED','3rd Year'],
    ['2024-00044','Anna Reyes',       'anna.r@student.chmsu.edu.ph', 'BSN','4th Year'],
    ['2024-00055','Maria Santos',     'maria.s@student.chmsu.edu.ph','BSED','3rd Year'],
];
$si = $pdo->prepare('INSERT INTO students (student_no,full_name,email,course,year_level) VALUES (?,?,?,?,?)');
foreach ($students as $s) $si->execute($s);
echo "[OK] students\n";

// Products
$products = [
    ['BSIT Polo Shirt','Official BSIT white polo w/ embroidered seal.','Uniforms',350.00,'../assets/images/uniformnobg.png',[
        ['size'=>'S','color'=>'Male','stock'=>12,'price'=>350],
        ['size'=>'M','color'=>'Male','stock'=>18,'price'=>350],
        ['size'=>'L','color'=>'Male','stock'=>15,'price'=>350],
        ['size'=>'XL','color'=>'Male','stock'=>8,'price'=>350],
        ['size'=>'S','color'=>'Female','stock'=>10,'price'=>350],
        ['size'=>'M','color'=>'Female','stock'=>14,'price'=>350],
    ]],
    ['BSIT Jacket','Warm uniform jacket with school seal.','Uniforms',650.00,'../assets/images/uniformnobg.png',[
        ['size'=>'M','color'=>'Unisex','stock'=>6,'price'=>650],
        ['size'=>'L','color'=>'Unisex','stock'=>10,'price'=>650],
        ['size'=>'XL','color'=>'Unisex','stock'=>4,'price'=>650],
    ]],
    ['PE Uniform Set','Complete PE set (shirt + shorts).','PE Attire',480.00,'../assets/images/uniformnobg.png',[
        ['size'=>'S','color'=>'Unisex','stock'=>20,'price'=>480],
        ['size'=>'M','color'=>'Unisex','stock'=>25,'price'=>480],
        ['size'=>'L','color'=>'Unisex','stock'=>15,'price'=>480],
    ]],
    ['PE Shorts','Dry-fit PE shorts.','PE Attire',180.00,'../assets/images/uniformnobg.png',[
        ['size'=>'S','color'=>'Unisex','stock'=>5,'price'=>180],
        ['size'=>'M','color'=>'Unisex','stock'=>18,'price'=>180],
        ['size'=>'L','color'=>'Unisex','stock'=>12,'price'=>180],
    ]],
    ['ID Lace','Official ID lace / lanyard.','Lanyards',25.00,'../assets/images/uniformnobg.png',[
        ['size'=>'Standard','color'=>'Maroon','stock'=>5,'price'=>25],
        ['size'=>'Standard','color'=>'Blue','stock'=>40,'price'=>25],
    ]],
    ['CHM Notebook','80-page CHM branded notebook.','College Items',65.00,'../assets/images/uniformnobg.png',[
        ['size'=>'A5','color'=>'Standard','stock'=>100,'price'=>65],
    ]],
];
foreach ($products as [$n,$d,$c,$p,$img,$variants]) {
    $pid = ProductModel::create(['name'=>$n,'description'=>$d,'category'=>$c,'price'=>$p,'image'=>$img,'status'=>'published']);
    foreach ($variants as $v) ProductModel::addVariant($pid, $v);
}
echo "[OK] products + variants\n";

// Orders — create several with different statuses + payment methods
$studentIds = array_column($pdo->query('SELECT id FROM students')->fetchAll(),'id');
$pRows = $pdo->query('SELECT id,price FROM products')->fetchAll();
$vByP  = [];
foreach ($pdo->query('SELECT id,product_id FROM product_variants')->fetchAll() as $v) $vByP[$v['product_id']][]=$v['id'];

$orderPlan = [
    ['Pending',          'Cash at BOA',      'Unpaid'],
    ['Pending',          'Online Payment',   'Paid'],
    ['Processing',       'Cash at BOA',      'Unpaid'],
    ['Processing',       'Online Payment',   'Paid'],
    ['Ready for Pickup', 'Online Payment',   'Paid'],
    ['Ready for Pickup', 'Cash at BOA',      'Unpaid'],
    ['Completed',        'Online Payment',   'Paid'],
    ['Completed',        'Cash at BOA',      'Paid'],
    ['Cancelled',        'Online Payment',   'Refunded'],
];

$pdo_ = $pdo;
foreach ($orderPlan as $idx => [$status,$pm,$ps]) {
    $sid = $studentIds[array_rand($studentIds)];
    $itemCount = rand(1,3);
    $items = [];
    for ($i=0;$i<$itemCount;$i++) {
        $p = $pRows[array_rand($pRows)];
        $vid = isset($vByP[$p['id']]) ? $vByP[$p['id']][array_rand($vByP[$p['id']])] : null;
        $items[] = ['product_id'=>$p['id'],'variant_id'=>$vid,'quantity'=>rand(1,2),'price'=>(float)$p['price']];
    }
    $oid = OrderModel::create($sid, $items, $status, $pm);
    // Set payment status explicitly + meta
    $meta = ['payment_status'=>$ps];
    if ($pm==='Online Payment') { $meta['payment_status']=$ps; $pdo_->prepare('UPDATE orders SET reference_number=? WHERE id=?')->execute(['REF-'.strtoupper(bin2hex(random_bytes(3))),$oid]); }
    if (in_array($status,['Processing','Ready for Pickup','Completed'],true)) { $meta['accepted_by']='Admin Rose';  $meta['accepted_date']=date('M j, Y / g:i A', strtotime('-2 days')); }
    if (in_array($status,['Ready for Pickup','Completed'],true)) { $meta['processed_by']='Admin Rose';$meta['processed_date']=date('M j, Y / g:i A', strtotime('-1 day')); }
    if ($status==='Completed') { $meta['completed_by']='Admin Rose'; $meta['completed_date']=date('M j, Y / g:i A'); }
    if ($status==='Cancelled') { $meta['cancel_reason']='Student request'; $meta['cancel_reason_date']=date('M j, Y / g:i A', strtotime('-3 days')); }
    OrderModel::updateStatus($oid, $status, $meta);
}
// Land a few orders today
$pdo->exec("UPDATE orders SET created_at=NOW() ORDER BY id DESC LIMIT 4");
echo "[OK] orders\n";

// Messages
$msgs = [
    ['student','Enna Reyes','iEnna.r@student.chmsu.edu.ph',null,null,'Order Status Inquiry',"Good day! I would like to follow up on my order #2024-0042 for a PE uniform. It has been 3 days and I have not received any update. Could you please check on this? Thank you.",'inbox',0,0],
    ['student','Dexter Argan','dexter.a@student.chmsu.edu.ph',null,null,'Wrong Item Received',"Hi Admin,\n\nI recently picked up my order from BAO and I received a medium-sized polo shirt instead of the large-sized one I ordered. My order number is #2024-0038.\n\nCan I have this exchanged? Looking forward to your response.\n\nThank you,\nDexter",'inbox',0,0],
    ['student','Joe Bayl','joe.b@student.chmsu.edu.ph',null,null,'Available Stock for PE Shorts?',"Good afternoon! I would like to ask if BSIT PE shorts are still available in size small. I tried to order online but it shows out of stock. Is there a restock scheduled?\n\nThank you!",'inbox',1,0],
    ['student','Richard Popye','richard.p@student.chmsu.edu.ph',null,null,'Request for Official Receipt',"Hi,\n\nI picked up my order last April 10 but I forgot to request an official receipt from BAO. Is it possible to get a copy of it? My order number is #2024-0035.\n\nThank you.",'inbox',1,0],
    ['student','Maria Santos','maria.s@student.chmsu.edu.ph',null,null,'Requesting Price List',"Good morning. Can you please send me the complete price list of all available items in the store? I am planning to order for the whole section. Thank you very much!",'inbox',1,1],
    ['system','CHMSTORE System','system@chmstore.edu.ph',null,null,'Low Stock Alert: ID Lace (5 remaining)',"STOCK ALERT\n\nItem: ID Lace\nCurrent Stock: 5 units\nThreshold: 10 units\n\nPlease reorder soon to avoid stockout.\n\n— CHMSTORE Automated Alert",'inbox',0,0],
    ['student','Anna Reyes','anna.r@student.chmsu.edu.ph',null,null,'Can I change my order?',"Hello Admin. I placed an order yesterday for a BSIT jacket size L (Order #2024-0044). I would like to change it to XL instead. Is it still possible to update the order?\n\nHope to hear from you soon. Thank you!",'inbox',1,0],
    ['admin','Admin Rose','admin@chmstore.edu.ph','Maria Santos','maria.s@student.chmsu.edu.ph','Re: Requesting Price List',"Hi Maria,\n\nThank you for reaching out! Here is the current price list:\n- BSIT Polo Shirt: ₱350.00\n- BSIT Jacket: ₱650.00\n- PE Uniform Set: ₱480.00\n- PE Shorts: ₱180.00\n- ID Lace: ₱25.00\n\nFor bulk orders (10+ pieces), please coordinate with BAO.\n\nBest regards,\nAdmin Rose",'sent',1,0],
    ['admin','Admin Rose','admin@chmstore.edu.ph','Anna Reyes','anna.r@student.chmsu.edu.ph','Re: Can I change my order?',"Hi Anna,\n\nGreat news! We updated your order. Your BSIT Jacket is now XL. Order #2024-0044 is being processed.\n\nBest regards,\nAdmin Rose",'sent',1,0],
    ['student','Liza Fernandez','liza.f@student.chmsu.edu.ph',null,null,'Resolved: Missing PE Shorts',"Hi Admin Rose,\n\nThank you so much! I already received my PE shorts at BAO. Resolved.\n\nBest,\nLiza",'archive',1,0],
    ['system','CHMSTORE System','system@chmstore.edu.ph',null,null,'Monthly Inventory Report – March 2024',"Top Selling Items:\n1. BSIT Polo Shirt — 85 units\n2. PE Uniform Set — 60 units\n3. BSIT Jacket — 42 units\n\nLow Stock:\n- ID Lace: 8 units\n- PE Shorts (Small): 5 units\n\nTotal Revenue: ₱98,450.00",'archive',1,1],
    ['student','Test Account','test@student.chmsu.edu.ph',null,null,'Test Message (Ignore)',"This is a test message. Please ignore.",'trash',1,0],
];
$mi = $pdo->prepare('INSERT INTO messages (sender_type,sender_name,sender_email,receiver_name,receiver_email,subject,body,folder,is_read,is_starred) VALUES (?,?,?,?,?,?,?,?,?,?)');
foreach ($msgs as $m) $mi->execute($m);
echo "[OK] messages\n";

echo "\nAll set. Login at adminLogin.php with  iamsuperadmin / Admin@123\n";
