@extends('admin.layout-simple')

@section('title', 'Dashboard - LAMDAKU Admin')
@section('page-title', 'Dashboard')

@section('styles')
<style>
/* Smooth Animations for Dashboard */
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

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes glow {
    0% {
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
    }
    50% {
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.6);
    }
    100% {
        box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-2px); }
    75% { transform: translateX(2px); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-8px);
    }
    60% {
        transform: translateY(-4px);
    }
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: scale(0.5);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Enhanced Stats Cards - Simplified */
.stats-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stats-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.stats-card.pages {
    border-top: 4px solid #667eea;
}

.stats-card.services {
    border-top: 4px solid #10b981;
}

.stats-card.timelines {
    border-top: 4px solid #3b82f6;
}

.stats-card.contacts {
    border-top: 4px solid #f59e0b;
}

.stats-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    transition: color 0.3s ease;
    position: relative;
}

.stats-card:hover .stats-icon {
    color: #667eea;
}

.stats-number {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 15px 0 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Welcome Card - Simplified */
.welcome-card {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    position: relative;
    overflow: hidden;
}

/* Quick Actions - Simplified */
.quick-actions-card {
    /* No entrance animation */
}

.quick-action-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.quick-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

/* Recent Contacts - Simplified */
.recent-contacts-card {
    /* No entrance animation */
}

.contact-item {
    transition: all 0.3s ease;
    border-radius: 12px;
    padding: 15px;
    margin: 10px 0;
    position: relative;
}

.contact-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* System Info - Simplified */
.system-info-card {
    /* No entrance animation */
}

/* Loading States - Removed */

/* Responsive */
@media (max-width: 768px) {
    .stats-card:hover {
        transform: none;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }
}

/* Hover Effects for Cards - Simplified */
.card {
    transition: box-shadow 0.3s ease;
    border: none;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    border-radius: 16px;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Page Load Animation */
.page-load {
    animation: fadeInUp 0.8s ease-out;
}

/* Stagger Animation for Multiple Elements */
.stagger-item {
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
}

.stagger-item:nth-child(1) { animation-delay: 0.1s; }
.stagger-item:nth-child(2) { animation-delay: 0.2s; }
.stagger-item:nth-child(3) { animation-delay: 0.3s; }
.stagger-item:nth-child(4) { animation-delay: 0.4s; }
.stagger-item:nth-child(5) { animation-delay: 0.5s; }

/* Smooth Scroll Behavior */
html {
    scroll-behavior: smooth;
}

/* Enhanced Badge Animation */
.badge {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.badge:hover::before {
    left: 100%;
}

.badge:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Loading Spinner for Dynamic Content */
.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: #667eea;
    animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Card Entrance Animations */
.card-entrance {
    animation: cardSlideIn 0.8s ease-out;
}

@keyframes cardSlideIn {
    from {
        opacity: 0;
        transform: translateY(50px) rotateX(-10deg);
    }
    to {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
    }
}

/* Gradient Text Animation */
.gradient-text {
    background: linear-gradient(45deg, #667eea, #764ba2, #667eea);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientShift 3s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Micro-interactions for Icons */
.icon-hover {
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.icon-hover:hover {
    transform: scale(1.2) rotate(5deg);
    color: #667eea !important;
}

/* Success Animation */
@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.success-animation {
    animation: successPulse 0.6s ease-in-out;
}
</style>
@endsection

@section('content')
<div class="row">
    <!-- Welcome Message -->
    <div class="col-12 mb-4">
        <div class="card welcome-card">
            <div class="card-body position-relative">                <h5 class="card-title gradient-text">
                    <i class="fas fa-home me-2 icon-hover"></i>
                    Selamat Datang di LAMDAKU Admin Dashboard
                </h5>
                <p class="card-text mb-3 opacity-75">
                    Kelola konten website dan data perusahaan dari sini dengan mudah dan efisien.
                </p>
                <div class="row align-items-center">
                    <div class="col-md-8">                        <small class="opacity-75">
                            <i class="fas fa-user me-1 icon-hover"></i>
                            Login sebagai: <strong>{{ session('admin_user', 'Administrator') }}</strong>
                        </small>
                        <br>
                        <small class="opacity-75">
                            <i class="fas fa-clock me-1 icon-hover"></i>
                            Terakhir login: {{ now()->format('d M Y H:i') }}
                        </small>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex justify-content-end gap-2">                            <span class="badge bg-light text-dark px-3 py-2">
                                <i class="fas fa-shield-alt me-1 icon-hover"></i>
                                Super Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">    <!-- Stats Cards -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card pages stagger-item" data-count="{{ $stats['pages'] ?? 0 }}">
            <div class="stats-icon text-primary">
                <i class="fas fa-file-alt fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['pages'] ?? 0 }}</div>
            <div class="text-muted fw-medium">Halaman</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card services stagger-item" data-count="{{ $stats['services'] ?? 0 }}">
            <div class="stats-icon text-success">
                <i class="fas fa-cogs fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['services'] ?? 0 }}</div>
            <div class="text-muted fw-medium">Layanan</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card timelines stagger-item" data-count="{{ $stats['timelines'] ?? 0 }}">
            <div class="stats-icon text-info">
                <i class="fas fa-history fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['timelines'] ?? 0 }}</div>
            <div class="text-muted fw-medium">Timeline</div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card contacts stagger-item" data-count="{{ $stats['contacts'] ?? 0 }}">
            <div class="stats-icon text-warning">
                <i class="fas fa-envelope fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['contacts'] ?? 0 }}</div>
            <div class="text-muted fw-medium">
                Kontak
                @if(($stats['unread_contacts'] ?? 0) > 0)
                    <span class="badge bg-danger ms-1">{{ $stats['unread_contacts'] }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">    <!-- Quick Actions -->
    <div class="col-md-6 mb-4">
        <div class="card quick-actions-card card-entrance">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-bolt me-2 icon-hover"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary w-100 quick-action-btn">
                            <i class="fas fa-plus-circle mb-2 d-block icon-hover"></i>
                            <small>Tambah Layanan</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.timelines.create') }}" class="btn btn-outline-success w-100 quick-action-btn">
                            <i class="fas fa-calendar-plus mb-2 d-block icon-hover"></i>
                            <small>Tambah Timeline</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-info w-100 quick-action-btn">
                            <i class="fas fa-file-plus mb-2 d-block"></i>
                            <small>Tambah Halaman</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-outline-secondary w-100 quick-action-btn">
                            <i class="fas fa-building mb-2 d-block"></i>
                            <small>Info Perusahaan</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- Recent Contacts -->
    <div class="col-md-6 mb-4">
        <div class="card recent-contacts-card card-entrance">
            <div class="card-header bg-gradient-info text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-envelope me-2 icon-hover"></i>
                    Pesan Terbaru
                </h6>
            </div>
            <div class="card-body">
                @if(isset($recent_contacts) && $recent_contacts->count() > 0)
                    @foreach($recent_contacts->take(4) as $contact)
                        <div class="contact-item {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong class="text-dark">{{ $contact->name }}</strong>
                                        @if(!$contact->is_read)
                                            <span class="badge bg-danger ms-2">Baru</span>
                                        @endif
                                    </div>
                                    <small class="text-muted d-block">{{ Str::limit($contact->message, 50) }}</small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-primary btn-sm w-100 quick-action-btn">
                            <i class="fas fa-eye me-1 icon-hover"></i>
                            Lihat Semua Pesan
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Belum ada pesan kontak.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">    <!-- System Info -->
    <div class="col-12">
        <div class="card system-info-card card-entrance">
            <div class="card-header bg-gradient-dark text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2 icon-hover"></i>
                    Informasi Sistem
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3 stagger-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-code text-primary icon-hover"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ app()->version() }}</h6>
                                <small class="text-muted">Laravel Version</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stagger-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fab fa-php text-success icon-hover"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ PHP_VERSION }}</h6>
                                <small class="text-muted">PHP Version</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stagger-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-server text-info icon-hover"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ app()->environment() }}</h6>
                                <small class="text-muted">Environment</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stagger-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-clock text-warning icon-hover"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" id="server-time">{{ now()->format('H:i:s') }}</h6>
                                <small class="text-muted">Server Time</small>
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animated Number Counter for Stats Cards
    function animateCounter(element, target, duration = 1000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        }
        
        // Delay the animation based on card position
        setTimeout(() => {
            updateCounter();
        }, 200);
    }

    // Initialize counter animations for stats cards
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach((card, index) => {
        const numberElement = card.querySelector('.stats-number');
        const targetValue = parseInt(card.getAttribute('data-count')) || 0;
        
        // Add entrance animation delay
        card.style.animationDelay = `${index * 0.1}s`;
        
        // Start counter animation after card appears
        setTimeout(() => {
            animateCounter(numberElement, targetValue, 1500);
        }, (index * 100) + 500);
    });

    // Smooth hover effects for quick action buttons
    const quickActionBtns = document.querySelectorAll('.quick-action-btn');
    quickActionBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        btn.addEventListener('click', function(e) {
            // Ripple effect on click
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });    // Auto-update server time with smooth transition
    function updateServerTime() {
        const timeElement = document.getElementById('server-time');
        if (timeElement) {
            const now = new Date();
            const newTime = now.toLocaleTimeString('id-ID');
            
            if (timeElement.textContent !== newTime) {
                timeElement.style.transform = 'scale(0.9)';
                timeElement.style.opacity = '0.7';
                
                setTimeout(() => {
                    timeElement.textContent = newTime;
                    timeElement.style.transform = 'scale(1)';
                    timeElement.style.opacity = '1';
                }, 100);
            }
        }
    }
    
    setInterval(updateServerTime, 1000);

    // Smooth reveal animation for contact items
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe contact items for reveal animation
    const contactItems = document.querySelectorAll('.contact-item');
    contactItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `all 0.6s ease ${index * 0.1}s`;
        observer.observe(item);
    });

    // Enhanced card hover effects with 3D transform
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(5px)`;
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
        });
    });    // Floating animation for stats icons
    const statsIcons = document.querySelectorAll('.stats-icon');
    statsIcons.forEach((icon, index) => {
        setInterval(() => {
            icon.style.transform = `translateY(${Math.sin(Date.now() * 0.002 + index) * 2}px)`;
        }, 16);
    });

    // Success notification system
    function showSuccessNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'success-notification';
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Animate out
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Add click handlers for success animations
    document.querySelectorAll('.quick-action-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.add('success-animation');
            setTimeout(() => {
                this.classList.remove('success-animation');
            }, 600);
        });
    });

    console.log('🎉 Dashboard animations initialized successfully!');
});

// Add CSS for ripple effect and notifications
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        pointer-events: none;
        animation: ripple-animation 0.6s ease-out;
    }
    
    @keyframes ripple-animation {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .success-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        z-index: 1000;
        font-weight: 500;
    }
    
    .success-notification.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .success-notification i {
        font-size: 1.2em;
    }
    
    #server-time {
        transition: all 0.2s ease;
    }
`;
document.head.appendChild(style);
</script>
@endsection
