// Koleksi Management
class KoleksiManager {
    constructor() {
        this.apiBaseUrl = '/api/koleksi';
        this.currentPage = 1;
        this.perPage = 12;
        this.searchQuery = '';
        this.categoryId = null;
        this.status = null;
        this.sortBy = 'created_at';
        this.sortOrder = 'desc';
        this.categories = [];
        
        this.init();
    }

    async init() {
        await this.loadCategories();
        this.setupEventListeners();
        await this.loadKoleksis();
    }

    async loadCategories() {
        try {
            const response = await fetch('/api/kategori');
            const data = await response.json();
            if (data.success) {
                this.categories = data.data;
                this.renderCategoryFilter();
            }
        } catch (error) {
            console.error('Error loading categories:', error);
        }
    }

    async loadKoleksis() {
        try {
            const params = new URLSearchParams({
                page: this.currentPage,
                per_page: this.perPage,
                sort_by: this.sortBy,
                sort_order: this.sortOrder,
            });

            if (this.searchQuery) {
                params.append('search', this.searchQuery);
            }

            if (this.categoryId && this.categoryId !== '') {
                params.append('category_id', this.categoryId);
            }

            if (this.status) {
                params.append('status', this.status);
            }

            const response = await fetch(`${this.apiBaseUrl}?${params}`);
            const data = await response.json();

            if (data.success) {
                this.renderKoleksis(data.data);
                this.renderPagination(data.pagination);
                this.updateResultsInfo(data.pagination);
            }
        } catch (error) {
            console.error('Error loading koleksis:', error);
            this.showError('Gagal memuat data koleksi');
        }
    }

    renderKoleksis(koleksis) {
        const grid = document.getElementById('koleksi-grid');
        if (!grid) return;

        if (koleksis.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <p class="text-sm text-slate-500">Tidak ada koleksi yang ditemukan</p>
                </div>
            `;
            return;
        }

        grid.innerHTML = koleksis.map(koleksi => {
            const statusClass = koleksi.status === 'tersedia' 
                ? 'bg-emerald-50 text-emerald-700' 
                : koleksi.status === 'dibooking'
                    ? 'bg-blue-50 text-blue-700'
                    : 'bg-slate-50 text-slate-600';
            
            const statusText = koleksi.status === 'tersedia' 
                ? 'Tersedia' 
                : koleksi.status === 'dibooking'
                    ? 'Dibooking'
                    : koleksi.status === 'dipinjam' 
                        ? 'Dipinjam' 
                        : koleksi.status;

            const coverImage = koleksi.cover_url 
                ? `<img src="${koleksi.cover_url}" alt="${this.escapeHtml(koleksi.judul)}" class="h-full w-full object-cover rounded-lg">`
                : `<div class="flex h-full w-full items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-12 w-12 text-slate-400">
                        <path d="M5 5.5C5 4.67157 5.67157 4 6.5 4H18C18.5523 4 19 4.44772 19 5V17.5C19 18.3284 18.3284 19 17.5 19H6.5C5.67157 19 5 18.3284 5 17.5V5.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M5 6C5 5.44772 4.55228 5 4 5C3.44772 5 3 5.44772 3 6V17.5C3 18.8807 4.11929 20 5.5 20H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 7.5H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9 10H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>`;

            return `
                <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:shadow-md cursor-pointer" onclick="window.location.href='/koleksi/${koleksi.id}'">
                    <div class="mb-3 h-48 overflow-hidden rounded-lg bg-slate-100">
                        ${coverImage}
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 line-clamp-2">
                        ${this.escapeHtml(koleksi.judul)}
                    </h3>
                    <p class="mt-1 text-xs text-slate-500">${this.escapeHtml(koleksi.penulis)}</p>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-[11px] text-slate-500">
                            ${koleksi.tahun_terbit} &bull; ${koleksi.category?.name || 'Umum'}
                        </span>
                        <span class="inline-flex rounded-full px-2 py-0.5 text-[10px] font-medium ${statusClass}">
                            ${statusText}
                        </span>
                    </div>
                </article>
            `;
        }).join('');
    }

    renderCategoryFilter() {
        const filterContainer = document.getElementById('category-filter');
        if (!filterContainer) return;

        const allCategoriesOption = `
            <button
                type="button"
                data-category-id=""
                class="category-filter-btn rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700 ${!this.categoryId ? 'border-emerald-600 text-emerald-700' : ''}"
            >
                Semua Kategori
            </button>
        `;

        const categoryButtons = this.categories.map(category => `
            <button
                type="button"
                data-category-id="${category.id}"
                class="category-filter-btn rounded-lg border border-slate-300 bg-white px-3 py-2 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700 ${this.categoryId == category.id ? 'border-emerald-600 text-emerald-700' : ''}"
            >
                ${this.escapeHtml(category.name)}
            </button>
        `).join('');

        filterContainer.innerHTML = allCategoriesOption + categoryButtons;

        // Add event listeners
        filterContainer.querySelectorAll('.category-filter-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const categoryId = e.target.dataset.categoryId || null;
                this.categoryId = categoryId;
                this.currentPage = 1;
                await this.loadKoleksis();
                this.updateCategoryFilterButtons();
            });
        });
    }

    updateCategoryFilterButtons() {
        document.querySelectorAll('.category-filter-btn').forEach(btn => {
            const btnCategoryId = btn.dataset.categoryId || null;
            const isActive = (btnCategoryId === '' && !this.categoryId) || (btnCategoryId == this.categoryId);
            
            if (isActive) {
                btn.classList.add('border-emerald-600', 'text-emerald-700');
                btn.classList.remove('border-slate-300', 'text-slate-700');
            } else {
                btn.classList.remove('border-emerald-600', 'text-emerald-700');
                btn.classList.add('border-slate-300', 'text-slate-700');
            }
        });
    }

    renderPagination(pagination) {
        const paginationContainer = document.getElementById('pagination');
        if (!paginationContainer) return;

        const { current_page, last_page, total } = pagination;

        if (last_page <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let paginationHTML = '';

        // Previous button
        paginationHTML += `
            <button
                type="button"
                data-page="${current_page - 1}"
                class="pagination-btn rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700 ${current_page === 1 ? 'disabled opacity-50 cursor-not-allowed' : ''}"
                ${current_page === 1 ? 'disabled' : ''}
            >
                Sebelumnya
            </button>
        `;

        // Page numbers
        const maxVisiblePages = 5;
        let startPage = Math.max(1, current_page - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(last_page, startPage + maxVisiblePages - 1);

        if (endPage - startPage < maxVisiblePages - 1) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }

        if (startPage > 1) {
            paginationHTML += `
                <button
                    type="button"
                    data-page="1"
                    class="pagination-btn rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700"
                >
                    1
                </button>
            `;
            if (startPage > 2) {
                paginationHTML += `<span class="px-2 text-xs text-slate-500">...</span>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <button
                    type="button"
                    data-page="${i}"
                    class="pagination-btn rounded-lg border px-3 py-1.5 text-xs font-medium shadow-sm transition ${
                        i === current_page
                            ? 'bg-emerald-600 text-white'
                            : 'border-slate-300 bg-white text-slate-700 hover:border-emerald-600 hover:text-emerald-700'
                    }"
                >
                    ${i}
                </button>
            `;
        }

        if (endPage < last_page) {
            if (endPage < last_page - 1) {
                paginationHTML += `<span class="px-2 text-xs text-slate-500">...</span>`;
            }
            paginationHTML += `
                <button
                    type="button"
                    data-page="${last_page}"
                    class="pagination-btn rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700"
                >
                    ${last_page}
                </button>
            `;
        }

        // Next button
        paginationHTML += `
            <button
                type="button"
                data-page="${current_page + 1}"
                class="pagination-btn rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 shadow-sm transition hover:border-emerald-600 hover:text-emerald-700 ${current_page === last_page ? 'disabled opacity-50 cursor-not-allowed' : ''}"
                ${current_page === last_page ? 'disabled' : ''}
            >
                Selanjutnya
            </button>
        `;

        paginationContainer.innerHTML = paginationHTML;

        // Add event listeners
        paginationContainer.querySelectorAll('.pagination-btn:not(:disabled)').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const page = parseInt(e.target.dataset.page);
                if (page && page !== this.currentPage && page >= 1 && page <= last_page) {
                    this.currentPage = page;
                    this.loadKoleksis();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });
    }

    updateResultsInfo(pagination) {
        const infoContainer = document.getElementById('results-info');
        if (!infoContainer) return;

        const { current_page, per_page, total } = pagination;
        const start = (current_page - 1) * per_page + 1;
        const end = Math.min(current_page * per_page, total);

        infoContainer.innerHTML = `
            Menampilkan <span class="font-semibold text-slate-900">${start}-${end}</span> dari
            <span class="font-semibold text-slate-900"> ${total}</span> buku
        `;
    }

    setupEventListeners() {
        // Search input with debounce
        const searchInput = document.getElementById('search-input');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.searchQuery = e.target.value.trim();
                    this.currentPage = 1;
                    this.loadKoleksis();
                }, 500);
            });
        }

        // Sort select
        const sortSelect = document.getElementById('sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                const value = e.target.value;
                switch (value) {
                    case 'terbaru':
                        this.sortBy = 'created_at';
                        this.sortOrder = 'desc';
                        break;
                    case 'judul-az':
                        this.sortBy = 'judul';
                        this.sortOrder = 'asc';
                        break;
                    case 'judul-za':
                        this.sortBy = 'judul';
                        this.sortOrder = 'desc';
                        break;
                    case 'populer':
                        this.sortBy = 'created_at';
                        this.sortOrder = 'desc';
                        break;
                    default:
                        this.sortBy = 'created_at';
                        this.sortOrder = 'desc';
                }
                this.currentPage = 1;
                this.loadKoleksis();
            });
        }
    }

    showError(message) {
        const grid = document.getElementById('koleksi-grid');
        if (grid) {
            grid.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <p class="text-sm text-red-600">${message}</p>
                </div>
            `;
        }
    }

    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('koleksi-grid')) {
            new KoleksiManager();
        }
    });
} else {
    if (document.getElementById('koleksi-grid')) {
        new KoleksiManager();
    }
}

