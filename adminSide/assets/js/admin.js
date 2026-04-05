let products = [
    { id: 1, name: 'CHMSU University Tee', category: 'Apparel', price: 450, stock: 85, desc: 'Premium cotton t-shirt', color: '#c25f90' },
    { id: 2, name: 'Campus Hoodie', category: 'Apparel', price: 850, stock: 62, desc: 'Cozy hoodie for campus', color: '#639cc7' },
    { id: 3, name: 'Baseball Cap', category: 'Accessories', price: 350, stock: 45, desc: 'Embroidered school logo cap', color: '#7c57a1' },
    { id: 4, name: 'Notebook Set', category: 'School Supplies', price: 280, stock: 5, desc: 'Set of 3 premium notebooks', color: '#0a5c36' },
    { id: 5, name: 'Campus Tote Bag', category: 'Accessories', price: 550, stock: 58, desc: 'Durable canvas bag', color: '#f8498c' },
    { id: 6, name: 'Sports Jersey', category: 'Apparel', price: 680, stock: 32, desc: 'Official sports team jersey', color: '#F07AAF' },
    { id: 7, name: 'Water Bottle', category: 'Accessories', price: 420, stock: 0, desc: 'Insulated steel bottle', color: '#2B85C1' },
    { id: 8, name: 'Study Planner', category: 'School Supplies', price: 320, stock: 28, desc: 'Academic year planner', color: '#8bbce0' }
];

if (localStorage.getItem('products')) {
    products = JSON.parse(localStorage.getItem('products'));
}

function save() {
    localStorage.setItem('products', JSON.stringify(products));
}

document.addEventListener('DOMContentLoaded', () => {
    initTabs();
    initCharts();
    renderProducts();
    renderInventory();
    updateStats();
    
    document.getElementById('productForm').addEventListener('submit', saveProduct);
    document.getElementById('stockForm').addEventListener('submit', updateStock);
    
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => sidebar.classList.toggle('active'));
    }
});

function initTabs() {
    document.querySelectorAll('.menu-item[data-tab]').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('.menu-item').forEach(m => m.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(t => t.classList.remove('active'));
            item.classList.add('active');
            document.getElementById(item.dataset.tab + '-tab').classList.add('active');
        });
    });
}

function renderProducts() {
    const container = document.getElementById('productsContainer');
    container.innerHTML = products.map(p => {
        const badge = p.stock === 0 ? 'Out of Stock' : p.stock <= 10 ? 'Low Stock' : 'In Stock';
        const badgeClass = p.stock === 0 ? 'badge-danger' : p.stock <= 10 ? 'badge-warning' : 'badge-success';
        return `
            <div class="product-card">
                <div class="product-img" style="background:${p.color}">
                    <span class="product-badge ${badgeClass}">${badge}</span>
                </div>
                <div class="product-body">
                    <div class="product-header">
                        <h3 class="product-title">${p.name}</h3>
                        <span class="product-category">${p.category}</span>
                    </div>
                    <p class="product-desc">${p.desc}</p>
                    <div class="product-footer">
                        <div class="product-stat">
                            <span>Price</span>
                            <strong>₱${p.price}</strong>
                        </div>
                        <div class="product-stat">
                            <span>Stock</span>
                            <strong>${p.stock}</strong>
                        </div>
                    </div>
                    <div class="product-actions">
                        <button class="btn-edit" onclick="editProduct(${p.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn-delete" onclick="deleteProduct(${p.id})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function renderInventory() {
    const container = document.getElementById('inventoryContainer');
    container.innerHTML = products.map(p => {
        const pct = Math.min((p.stock / 100) * 100, 100);
        const fillClass = p.stock === 0 ? 'danger' : p.stock <= 10 ? 'warning' : '';
        const badge = p.stock === 0 ? 'Out' : p.stock <= 10 ? 'Low' : 'Good';
        const badgeClass = p.stock === 0 ? 'danger' : p.stock <= 10 ? 'warning' : 'good';
        return `
            <div class="inventory-card">
                <div class="inventory-img" style="background:${p.color}"></div>
                <h4 class="inventory-name">${p.name}</h4>
                <div class="stock-row">
                    <span>Stock:</span>
                    <strong>${p.stock} units</strong>
                </div>
                <div class="stock-bar">
                    <div class="stock-fill ${fillClass}" style="width:${pct}%"></div>
                </div>
                <div class="inventory-actions">
                    <button class="btn-update" onclick="openStockModal(${p.id})">Update</button>
                    <span class="stock-badge ${badgeClass}">${badge}</span>
                </div>
            </div>
        `;
    }).join('');
}

function updateStats() {
    const total = products.reduce((a, p) => a + p.stock, 0);
    const low = products.filter(p => p.stock > 0 && p.stock <= 10).length;
    const out = products.filter(p => p.stock === 0).length;
    const good = products.filter(p => p.stock > 10).length;
    
    document.getElementById('totalProducts').textContent = products.length;
    document.getElementById('invTotal').textContent = total;
    document.getElementById('invLow').textContent = low;
    document.getElementById('invOut').textContent = out;
    document.getElementById('invGood').textContent = good;
}

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Add Product';
    document.getElementById('productForm').reset();
    document.getElementById('editId').value = '';
    document.getElementById('productModal').classList.add('active');
}

function editProduct(id) {
    const p = products.find(x => x.id === id);
    document.getElementById('modalTitle').textContent = 'Edit Product';
    document.getElementById('editId').value = p.id;
    document.getElementById('prodName').value = p.name;
    document.getElementById('prodCategory').value = p.category;
    document.getElementById('prodPrice').value = p.price;
    document.getElementById('prodStock').value = p.stock;
    document.getElementById('prodDesc').value = p.desc;
    document.getElementById('prodColor').value = p.color;
    document.getElementById('productModal').classList.add('active');
}

function deleteProduct(id) {
    if (confirm('Delete this product?')) {
        products = products.filter(p => p.id !== id);
        save();
        renderProducts();
        renderInventory();
        updateStats();
        notify('Product deleted');
    }
}

function saveProduct(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const data = {
        name: document.getElementById('prodName').value,
        category: document.getElementById('prodCategory').value,
        price: parseFloat(document.getElementById('prodPrice').value),
        stock: parseInt(document.getElementById('prodStock').value),
        desc: document.getElementById('prodDesc').value,
        color: document.getElementById('prodColor').value
    };
    
    if (id) {
        const idx = products.findIndex(p => p.id == id);
        products[idx] = { ...products[idx], ...data };
        notify('Product updated');
    } else {
        products.push({ id: Date.now(), ...data });
        notify('Product added');
    }
    
    save();
    renderProducts();
    renderInventory();
    updateStats();
    closeModal();
}

function openStockModal(id) {
    const p = products.find(x => x.id === id);
    document.getElementById('stockId').value = p.id;
    document.getElementById('stockName').value = p.name;
    document.getElementById('stockCurrent').value = p.stock;
    document.getElementById('stockNew').value = '';
    document.getElementById('stockModal').classList.add('active');
}

function updateStock(e) {
    e.preventDefault();
    const id = parseInt(document.getElementById('stockId').value);
    const newStock = parseInt(document.getElementById('stockNew').value);
    const p = products.find(x => x.id === id);
    p.stock = newStock;
    save();
    renderInventory();
    updateStats();
    closeStockModal();
    notify('Stock updated');
}

function closeModal() {
    document.getElementById('productModal').classList.remove('active');
}

function closeStockModal() {
    document.getElementById('stockModal').classList.remove('active');
}

function notify(msg) {
    const div = document.createElement('div');
    div.textContent = msg;
    div.style.cssText = 'position:fixed;top:20px;right:20px;background:#4caf50;color:white;padding:15px 25px;border-radius:8px;z-index:9999;animation:slideIn 0.3s';
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 2000);
}

function initCharts() {
    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                data: [5200, 6300, 5800, 7100, 6900, 8500, 7800],
                borderColor: '#f8498c',
                backgroundColor: 'rgba(248,73,140,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
    
    new Chart(document.getElementById('activityChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                data: [145, 182, 168, 195, 210, 175, 142],
                backgroundColor: '#2B85C1',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });
    
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: ['Apparel', 'Accessories', 'School', 'Special'],
            datasets: [{
                data: [45, 28, 20, 7],
                backgroundColor: ['#c25f90', '#639cc7', '#7c57a1', '#0a5c36']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
}