@extends('layouts.app')

@section('main-class', '')
@section('main-spacing', '')

@section('content')
<div class="w-100">
    <!-- Hero Section - Full Screen dengan UnoCSS/Tailwind approach -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center hero-content">
                    <div class="mb-4">
                        <h1 class="hero-title">VOIDGame</h1>
                        <div class="hero-icons">
                            <i class="bi bi-android2 icon-float icon-warning"></i>
                            <i class="bi bi-xbox icon-float icon-info"></i>
                            <i class="bi bi-steam icon-float icon-success"></i>
                        </div>
                    </div>
                    <h2 class="hero-subtitle">RANCANG RUANG PROJECT</h2>
                    <h3 class="hero-accent">GAME COMPETITIF</h3>
                    <p class="hero-description">Your One-Stop Shop for All Your Game Needs</p>
                    <p class="hero-subdescription">Explore premium game and console for professional results!</p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-hero">
                            <i class="bi bi-shop me-2"></i>Shop Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-hero">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Shop Now
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section dengan CSS Grid -->
    <div class="categories-section">
        <div class="section-header">
            <h2 class="section-title">Browse by Category</h2>
            <p class="section-description">Find exactly what you're looking for in our specialized categories</p>
            <a href="{{ route('categories.index') }}" class="btn-outline">
                View All Categories <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="categories-grid">
            @foreach($categories as $category)
            <div class="category-card">
                <div class="category-content">
                    @if($category->icon)
                        <i class="bi {{ $category->icon }} category-icon"></i>
                    @endif
                    <h5 class="category-title">{{ $category->name }}</h5>
                    <p class="category-description">{{ Str::limit($category->description, 80) }}</p>
                    <a href="{{ route('categories.show', $category) }}" class="btn-category">
                        Explore
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="container">
            <div class="welcome-header">
                <h2 class="welcome-title">Selamat Datang di VOIDGame</h2>
                <p class="welcome-description">Kami menyediakan berbagai Game dan Console berkualitas tinggi untuk kebutuhan Anda!</p>
            </div>

            <!-- Products Grid dengan CSS Grid Modern -->
            <div class="products-grid">
                @forelse ($products as $product)
                    <div class="product-card">
                        <!-- Product Image -->
                        <div class="product-image">
                            @if ($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-img">
                            @else
                                <div class="product-placeholder">
                                    <i class="bi bi-image"></i>
                                    <span>No Image Available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="product-body">
                            <h5 class="product-title">{{ $product->name }}</h5>

                            @if($product->description)
                                <p class="product-description">
                                    {{ Str::limit($product->description, 100) }}
                                </p>
                            @else
                                <p class="product-description">No description available</p>
                            @endif

                            <!-- Price and Stock dengan Flexbox -->
                            <div class="product-meta">
                                <span class="price-badge">
                                    <i class="bi bi-currency-dollar"></i>${{ number_format($product->price, 2) }}
                                </span>
                                @if($product->stock > 0)
                                    <span class="stock-badge stock-available">
                                        <i class="bi bi-box"></i>{{ $product->stock }} in stock
                                    </span>
                                @else
                                    <span class="stock-badge stock-unavailable">
                                        <i class="bi bi-x-circle"></i>Out of stock
                                    </span>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="product-actions">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="btn-primary-action">
                                        <i class="bi bi-cart-plus"></i>Beli Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-primary-action">
                                        <i class="bi bi-box-arrow-in-right"></i>Beli Sekarang
                                    </a>
                                @endauth
                                <button class="btn-secondary-action" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                    <i class="bi bi-info-circle"></i>Lihat Info
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Info Modal tetap sama -->
                    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if ($product->image)
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded">
                                            @else
                                                <div class="bg-light text-center p-5 rounded">
                                                    <i class="bi bi-image display-1 text-muted"></i>
                                                    <p class="text-muted">No Image Available</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="fw-bold">Product Details</h5>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Price:</strong></td>
                                                    <td>${{ number_format($product->price, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Stock:</strong></td>
                                                    <td>{{ $product->stock }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Description:</strong></td>
                                                    <td>{{ $product->description ?? 'No description available' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Buy Now
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            <i class="bi bi-box-arrow-in-right me-2"></i>Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-box-seam empty-icon"></i>
                        <h3 class="empty-title">No Products Available</h3>
                        <p class="empty-description">Check back soon for new products!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modern CSS dengan CSS Custom Properties dan Advanced Features --}}
<style>
/* ============================================
   MODERN CSS dengan CSS Custom Properties 
   Inspired by Stitches, Panda CSS, dan UnoCSS
   ============================================ */

/* CSS Custom Properties (Design Tokens) */
:root {
  /* Colors - Design System */
  --color-primary-50: #eff6ff;
  --color-primary-100: #dbeafe;
  --color-primary-500: #3b82f6;
  --color-primary-600: #2563eb;
  --color-primary-700: #1d4ed8;
  
  --color-accent-50: #fefce8;
  --color-accent-400: #facc15;
  --color-accent-500: #eab308;
  
  --color-success-500: #10b981;
  --color-warning-500: #f59e0b;
  --color-danger-500: #ef4444;
  --color-info-500: #06b6d4;
  
  --color-gray-50: #f9fafb;
  --color-gray-100: #f3f4f6;
  --color-gray-200: #e5e7eb;
  --color-gray-300: #d1d5db;
  --color-gray-600: #4b5563;
  --color-gray-700: #374151;
  --color-gray-800: #1f2937;
  --color-gray-900: #111827;
  
  /* Spacing Scale */
  --space-1: 0.25rem;
  --space-2: 0.5rem;
  --space-3: 0.75rem;
  --space-4: 1rem;
  --space-5: 1.25rem;
  --space-6: 1.5rem;
  --space-8: 2rem;
  --space-10: 2.5rem;
  --space-12: 3rem;
  --space-16: 4rem;
  --space-20: 5rem;
  
  /* Typography Scale */
  --font-size-xs: 0.75rem;
  --font-size-sm: 0.875rem;
  --font-size-base: 1rem;
  --font-size-lg: 1.125rem;
  --font-size-xl: 1.25rem;
  --font-size-2xl: 1.5rem;
  --font-size-3xl: 1.875rem;
  --font-size-4xl: 2.25rem;
  --font-size-5xl: 3rem;
  --font-size-6xl: 3.75rem;
  
  /* Border Radius */
  --radius-sm: 0.375rem;
  --radius-md: 0.5rem;
  --radius-lg: 0.75rem;
  --radius-xl: 1rem;
  --radius-2xl: 1.5rem;
  
  /* Shadows */
  --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  
  /* Gradients */
  --gradient-hero: linear-gradient(135deg, 
    hsl(220, 65%, 25%) 0%, 
    hsl(215, 60%, 35%) 25%, 
    hsl(210, 55%, 45%) 50%, 
    hsl(185, 40%, 55%) 75%, 
    hsl(160, 45%, 65%) 100%);
    
  --gradient-card: linear-gradient(145deg, 
    rgba(255, 255, 255, 0.9) 0%, 
    rgba(255, 255, 255, 0.7) 100%);
}

/* Reset dan Base Styles */
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  line-height: 1.6;
  color: var(--color-gray-800);
}

/* ============================================
   HERO SECTION - Modern Glassmorphism Design
   ============================================ */
.hero-section {
  background: var(--gradient-hero);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: 
    radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 70% 80%, rgba(255, 215, 0, 0.1) 0%, transparent 50%);
  backdrop-filter: blur(1px);
}

.hero-content {
  position: relative;
  z-index: 10;
  animation: fadeInUp 1.2s cubic-bezier(0.16, 1, 0.3, 1);
}

.hero-title {
  font-size: clamp(var(--font-size-4xl), 8vw, var(--font-size-6xl));
  font-weight: 800;
  color: var(--color-accent-400);
  text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
  letter-spacing: 0.05em;
  margin-bottom: var(--space-6);
  background: linear-gradient(135deg, #ffd700, #ffed4e);
  background-clip: text;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-icons {
  margin-bottom: var(--space-8);
}

.icon-float {
  font-size: var(--font-size-4xl);
  margin: 0 var(--space-3);
  animation: float 3s ease-in-out infinite;
  filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
}

.icon-warning { color: var(--color-warning-500); animation-delay: 0s; }
.icon-info { color: var(--color-info-500); animation-delay: 0.5s; }
.icon-success { color: var(--color-success-500); animation-delay: 1s; }

.hero-subtitle {
  font-size: clamp(var(--font-size-2xl), 4vw, var(--font-size-4xl));
  font-weight: 700;
  color: white;
  margin-bottom: var(--space-4);
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
}

.hero-accent {
  font-size: var(--font-size-2xl);
  font-weight: 600;
  color: var(--color-accent-400);
  margin-bottom: var(--space-6);
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.hero-description {
  font-size: var(--font-size-lg);
  color: rgba(255, 255, 255, 0.95);
  margin-bottom: var(--space-2);
  font-weight: 500;
}

.hero-subdescription {
  font-size: var(--font-size-base);
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: var(--space-8);
}

.btn-hero {
  display: inline-flex;
  align-items: center;
  padding: var(--space-4) var(--space-8);
  background: var(--color-accent-500);
  color: white;
  text-decoration: none;
  border-radius: var(--radius-lg);
  font-weight: 600;
  font-size: var(--font-size-lg);
  box-shadow: var(--shadow-lg);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 2px solid transparent;
}

.btn-hero:hover {
  transform: translateY(-2px) scale(1.02);
  box-shadow: 0 25px 50px -12px rgba(234, 179, 8, 0.4);
  background: var(--color-accent-400);
  color: var(--color-gray-900);
}

/* ============================================
   CATEGORIES SECTION - CSS Grid Layout
   ============================================ */
.categories-section {
  padding: var(--space-20) var(--space-4);
  background: linear-gradient(to bottom, var(--color-gray-50), white);
}

.section-header {
  text-align: center;
  margin-bottom: var(--space-12);
}

.section-title {
  font-size: var(--font-size-4xl);
  font-weight: 700;
  color: var(--color-gray-900);
  margin-bottom: var(--space-4);
}

.section-description {
  font-size: var(--font-size-lg);
  color: var(--color-gray-600);
  margin-bottom: var(--space-6);
}

.btn-outline {
  display: inline-flex;
  align-items: center;
  gap: var(--space-2);
  padding: var(--space-3) var(--space-6);
  border: 2px solid var(--color-primary-500);
  color: var(--color-primary-600);
  text-decoration: none;
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: all 0.2s ease;
}

.btn-outline:hover {
  background: var(--color-primary-500);
  color: white;
  transform: translateY(-1px);
}

.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: var(--space-6);
  max-width: 1200px;
  margin: 0 auto;
}

.category-card {
  background: white;
  border-radius: var(--radius-xl);
  padding: var(--space-8);
  text-align: center;
  box-shadow: var(--shadow-sm);
  border: 1px solid var(--color-gray-100);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.category-card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: var(--gradient-card);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.category-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-xl);
  border-color: var(--color-primary-200);
}

.category-card:hover::before {
  opacity: 1;
}

.category-content {
  position: relative;
  z-index: 1;
}

.category-icon {
  font-size: var(--font-size-5xl);
  color: var(--color-primary-500);
  margin-bottom: var(--space-4);
  display: block;
}

.category-title {
  font-size: var(--font-size-xl);
  font-weight: 600;
  color: var(--color-gray-900);
  margin-bottom: var(--space-3);
}

.category-description {
  font-size: var(--font-size-sm);
  color: var(--color-gray-600);
  margin-bottom: var(--space-6);
  line-height: 1.5;
}

.btn-category {
  display: inline-flex;
  align-items: center;
  padding: var(--space-2) var(--space-4);
  background: var(--color-primary-50);
  color: var(--color-primary-600);
  text-decoration: none;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: 500;
  transition: all 0.2s ease;
}

.btn-category:hover {
  background: var(--color-primary-500);
  color: white;
}

/* ============================================
   WELCOME & PRODUCTS SECTION
   ============================================ */
.welcome-section {
  padding: var(--space-20) 0;
}

.welcome-header {
  text-align: center;
  margin-bottom: var(--space-16);
}

.welcome-title {
  font-size: var(--font-size-4xl);
  font-weight: 700;
  color: var(--color-primary-600);
  margin-bottom: var(--space-4);
}

.welcome-description {
  font-size: var(--font-size-lg);
  color: var(--color-gray-600);
  max-width: 600px;
  margin: 0 auto;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: var(--space-8);
  padding: 0 var(--space-4);
}

.product-card {
  background: white;
  border-radius: var(--radius-xl);
  overflow: hidden;
  box-shadow: var(--shadow-md);
  border: 1px solid var(--color-gray-100);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  display: flex;
  flex-direction: column;
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-xl);
}

.product-image {
  height: 200px;
  background: var(--color-gray-50);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.product-card:hover .product-img {
  transform: scale(1.05);
}

.product-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: var(--space-2);
  color: var(--color-gray-400);
}

.product-placeholder i {
  font-size: var(--font-size-4xl);
}

.product-body {
  padding: var(--space-6);
  display: flex;
  flex-direction: column;
  flex: 1;
}

.product-title {
  font-size: var(--font-size-xl);
  font-weight: 600;
  color: var(--color-gray-900);
  margin-bottom: var(--space-3);
}

.product-description {
  font-size: var(--font-size-sm);
  color: var(--color-gray-600);
  margin-bottom: var(--space-4);
  line-height: 1.5;
  flex: 1;
}

.product-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: var(--space-6);
  gap: var(--space-3);
  flex-wrap: wrap;
}

.price-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--space-1);
  padding: var(--space-2) var(--space-4);
  background: var(--color-success-500);
  color: white;
  border-radius: var(--radius-md);
  font-size: var(--font-size-sm);
  font-weight: 600;
}

.stock-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--space-1);
  padding: var(--space-2) var(--space-3);
  border-radius: var(--radius-md);
  font-size: var(--font-size-xs);
  font-weight: 500;
}

.stock-available {
  background: var(--color-primary-50);
  color: var(--color-primary-600);
}

.stock-unavailable {
  background: var(--color-danger-500);
  color: white;
}

.product-actions {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

.btn-primary-action {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  padding: var(--space-3) var(--space-4);
  background: var(--color-primary-500);
  color: white;
  text-decoration: none;
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
}

.btn-primary-action:hover {
  background: var(--color-primary-600);
  transform: translateY(-1px);
}

.btn-secondary-action {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: var(--space-2);
  padding: var(--space-3) var(--space-4);
  background: var(--color-gray-100);
  color: var(--color-gray-700);
  border: 1px solid var(--color-gray-200);
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: all 0.2s ease;
  cursor: pointer;
}

.btn-secondary-action:hover {
  background: var(--color-gray-200);
  border-color: var(--color-gray-300);
}

/* ============================================
   EMPTY STATE
   ============================================ */
.empty-state {
  grid-column: 1 / -1;
  text-align: center;
  padding: var(--space-20);
}

.empty-icon {
  font-size: 5rem;
  color: var(--color-gray-300);
  margin-bottom: var(--space-4);
}

.empty-title {
  font-size: var(--font-size-2xl);
  font-weight: 600;
  color: var(--color-gray-600);
  margin-bottom: var(--space-2);
}

.empty-description {
  font-size: var(--font-size-base);
  color: var(--color-gray-500);
}

/* ============================================
   ANIMATIONS
   ============================================ */
@keyframes float {
  0%, 100% { 
    transform: translateY(0px); 
  }
  50% { 
    transform: translateY(-10px); 
  }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */
@media (max-width: 768px) {
  .hero-title {
    font-size: var(--font-size-4xl);
    letter-spacing: 0.02em;
  }
  
  .hero-subtitle {
    font-size: var(--font-size-2xl);
  }
  
  .hero-accent {
    font-size: var(--font-size-xl);
  }
  
  .icon-float {
    font-size: var(--font-size-2xl);
    margin: 0 var(--space-2);
  }
  
  .categories-grid {
    grid-template-columns: 1fr;
    padding: 0 var(--space-4);
  }
  
  .products-grid {
    grid-template-columns: 1fr;
  }
  
  .product-meta {
    flex-direction: column;
    align-items: flex-start;
  }
}

@media (max-width: 576px) {
  .hero-title {
    font-size: var(--font-size-3xl);
  }
  
  .btn-hero {
    padding: var(--space-3) var(--space-6);
    font-size: var(--font-size-base);
  }
  
  .section-title {
    font-size: var(--font-size-3xl);
  }
  
  .welcome-title {
    font-size: var(--font-size-3xl);
  }
}

/* ============================================
   DARK MODE SUPPORT
   ============================================ */
@media (prefers-color-scheme: dark) {
  :root {
    --color-gray-50: #1f2937;
    --color-gray-100: #374151;
    --color-gray-200: #4b5563;
    --color-gray-300: #6b7280;
    --color-gray-600: #d1d5db;
    --color-gray-700: #e5e7eb;
    --color-gray-800: #f9fafb;
    --color-gray-900: #ffffff;
  }
  
  .hero-section {
    background: linear-gradient(135deg, 
      hsl(220, 65%, 15%) 0%, 
      hsl(215, 60%, 25%) 25%, 
      hsl(210, 55%, 35%) 50%, 
      hsl(185, 40%, 45%) 75%, 
      hsl(160, 45%, 55%) 100%);
  }
  
  .categories-section {
    background: linear-gradient(to bottom, var(--color-gray-50), #111827);
  }
  
  .category-card,
  .product-card {
    background: var(--color-gray-100);
    border-color: var(--color-gray-200);
  }
  
  .btn-secondary-action {
    background: var(--color-gray-200);
    color: var(--color-gray-800);
    border-color: var(--color-gray-300);
  }
}

/* ============================================
   MICRO-INTERACTIONS & ADVANCED ANIMATIONS
   ============================================ */
@keyframes shimmer {
  0% { background-position: -200px 0; }
  100% { background-position: calc(200px + 100%) 0; }
}

.product-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.2),
    transparent
  );
  transition: left 0.5s;
  z-index: 1;
}

.product-card:hover::before {
  left: 100%;
}

/* Staggered Animation for Product Grid */
.product-card {
  animation: slideInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
}

.product-card:nth-child(1) { animation-delay: 0.1s; }
.product-card:nth-child(2) { animation-delay: 0.2s; }
.product-card:nth-child(3) { animation-delay: 0.3s; }
.product-card:nth-child(4) { animation-delay: 0.4s; }
.product-card:nth-child(5) { animation-delay: 0.5s; }
.product-card:nth-child(6) { animation-delay: 0.6s; }

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Loading States */
.loading-skeleton {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200px 100%;
  animation: shimmer 1.5s infinite;
}

/* Focus States for Accessibility */
.btn-hero:focus,
.btn-outline:focus,
.btn-category:focus,
.btn-primary-action:focus,
.btn-secondary-action:focus {
  outline: 2px solid var(--color-primary-500);
  outline-offset: 2px;
}

/* High Performance CSS */
.product-card,
.category-card {
  contain: layout style paint;
  will-change: transform;
}

/* Print Styles */
@media print {
  .hero-section {
    background: white !important;
    color: black !important;
    min-height: auto !important;
  }
  
  .btn-hero,
  .btn-outline,
  .btn-category,
  .btn-primary-action,
  .btn-secondary-action {
    display: none !important;
  }
}

/* ============================================
   CONTAINER QUERIES (Future-proof)
   ============================================ */
.product-actions {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}

@media (min-width: 400px) {
  .product-actions {
    flex-direction: row;
  }
}
/* ============================================
   CSS LOGICAL PROPERTIES
   ============================================ */
.hero-content {
  margin-block-end: var(--space-8);
  padding-inline: var(--space-4);
}

.product-body {
  padding-block: var(--space-6);
  padding-inline: var(--space-6);
}

/* ============================================
   PERFORMANCE OPTIMIZATIONS
   ============================================ */
img {
  content-visibility: auto;
  contain-intrinsic-size: 200px;
}

.products-grid {
  content-visibility: auto;
  contain-intrinsic-size: 0 500px;
}
</style>

{{-- Alternative: Inline CSS-in-JS Style untuk React-like experience --}}
{{-- 
<script>
// Jika ingin menggunakan CSS-in-JS approach seperti Styled Components
const createStyledComponent = (tag, styles) => {
  const element = document.createElement(tag);
  Object.assign(element.style, styles);
  return element;
};

// Usage example:
const StyledButton = createStyledComponent('button', {
  padding: 'var(--space-4) var(--space-8)',
  background: 'var(--color-primary-500)',
  color: 'white',
  border: 'none',
  borderRadius: 'var(--radius-md)',
  cursor: 'pointer',
  transition: 'all 0.2s ease'
});
</script>
--}}
@endsection