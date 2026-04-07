@extends('admin.layout-simple')
@section('title', 'Dashboard - LAMDAKU Admin')
@section('page-title', 'Dashboard')
@section('styles')
<style>
/* DASHBOARD FIXED - TANPA EFEK GERAK BERLEBIHAN */

/* Enhanced Stats Cards - FIXED VERSION */
.stats-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
    /* HAPUS semua transition dan animation */
}

/* Hover hanya mengubah shadow sedikit, TIDAK bergerak */
.stats-card:hover {
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    /* TIDAK ADA transform, scale, translateY, dll */
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

/* Stats Icon - FIXED - Tidak Bergerak */
.stats-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    position: relative;
    /* HAPUS semua transition dan animation */
}

/* Hover icon hanya mengubah warna, TIDAK bergerak */
.stats-card:hover .stats-icon {
    color: #667eea;
    /* TIDAK ADA transform, rotation, scale, dll */
}

.stats-number {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 15px 0 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    /* Angka langsung tampil, TIDAK ada animasi counter */
}

/* Welcome Card - FIXED */
.welcome-card {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    position: relative;
    overflow: hidden;
    /* HAPUS entrance animation */
}

/* Quick Actions - FIXED */
.quick-action-btn {
    position: relative;
    overflow: hidden;
    /* HAPUS transition berlebihan */
}

.quick-action-btn:hover {
    background-color: #f8f9fa;
    /* HAPUS translateY dan box-shadow berlebihan */
}

/* Contact Items - FIXED */
.contact-item {
    border-radius: 12px;
    padding: 15px;
    margin: 10px 0;
    position: relative;
    /* HAPUS transition */
}

.contact-item:hover {
    background: #f8f9fa;
    /* HAPUS transform translateX */
}

/* System Info - FIXED */
.system-info-card {
    /* HAPUS entrance animation */
}

/* Loading States - HAPUS SEMUA */
/* TIDAK ADA loading animation */

/* Responsive - FIXED */
@media (max-width: 768px) {
    .stats-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* HAPUS transform apapun */
    }
}

/* Cards Umum - FIXED */
.card {
    border: none;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    /* HAPUS transition berlebihan */
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    /* TIDAK ADA transform */
}

/* Stagger Items - HAPUS SEMUA ANIMASI */
.stagger-item {
    /* HAPUS semua animation dan entrance effect */
}

/* Button Hover - MINIMAL */
.btn:hover {
    /* Hanya perubahan warna, TIDAK ada transform */
}

</style>
@endsection
