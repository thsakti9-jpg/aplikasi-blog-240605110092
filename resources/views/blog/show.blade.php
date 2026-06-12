@extends('blog.layouts.app')

@section('title', $artikel->judul)

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('blog.index') }}"><i class="fas fa-home"></i> Beranda</a></li>
        <li class="breadcrumb-item">
            <a href="{{ route('blog.index', ['kategori' => $artikel->id_kategori]) }}">
                {{ $artikel->kategori->nama_kategori }}
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($artikel->judul, 50, '...') }}</li>
    </ol>
</nav>

<div class="row">
    <!-- Article Content -->
    <div class="col-lg-8">
        <article style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);">
            <!-- Featured Image -->
            <div style="width: 100%; height: 400px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <img src="{{ asset('storage/gambar/' . $artikel->gambar) }}" 
                     alt="{{ $artikel->judul }}"
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.src='https://via.placeholder.com/800x400?text=Article+Image'">
            </div>

            <!-- Article Header -->
            <div style="padding: 2rem; border-bottom: 1px solid #e5e7eb;">
                <div style="margin-bottom: 1rem;">
                    <span style="display: inline-block; background: #f59e0b; color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                        {{ $artikel->kategori->nama_kategori }}
                    </span>
                </div>

                <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: #1f2937; line-height: 1.3;">
                    {{ $artikel->judul }}
                </h1>

                <!-- Author & Date -->
                <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; color: #6b7280; font-size: 0.95rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <img src="{{ asset('storage/foto/' . $artikel->penulis->foto) }}" 
                             alt="{{ $artikel->penulis->nama_depan }}"
                             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #2563eb;"
                             onerror="this.src='https://via.placeholder.com/40x40?text=Author'">
                        <div>
                            <div style="font-weight: 600; color: #1f2937;">
                                {{ $artikel->penulis->nama_depan }} {{ $artikel->penulis->nama_belakang }}
                            </div>
                        </div>
                    </div>
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fas fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($artikel->hari_tanggal)->locale('id')->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            <!-- Article Content -->
            <div style="padding: 2rem;">
                <div style="font-size: 1.05rem; line-height: 1.8; color: #374151;">
                    {!! nl2br(e($artikel->isi)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <div style="padding: 2rem; border-top: 1px solid #e5e7eb; background: #f9fafb; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <a href="{{ route('blog.index', ['kategori' => $artikel->id_kategori]) }}" 
                   style="color: #2563eb; text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
                   onmouseover="this.style.color='#1e40af';"
                   onmouseout="this.style.color='#2563eb';">
                    <i class="fas fa-arrow-left"></i> Kembali ke {{ $artikel->kategori->nama_kategori }}
                </a>
                <a href="{{ route('blog.index') }}" 
                   style="color: #2563eb; text-decoration: none; font-weight: 500; transition: all 0.3s ease;"
                   onmouseover="this.style.color='#1e40af';"
                   onmouseout="this.style.color='#2563eb';">
                    <i class="fas fa-home"></i> Ke Beranda
                </a>
            </div>
        </article>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Categories Widget -->
        <div class="sidebar-widget">
            <h5>
                <i class="fas fa-folder-open"></i> Kategori
            </h5>
            <ul class="category-list">
                <li>
                    <a href="{{ route('blog.index') }}">
                        <span><i class="fas fa-list"></i> Semua Artikel</span>
                        <span class="badge">{{ \App\Models\Artikel::count() }}</span>
                    </a>
                </li>
                @foreach($kategori as $kat)
                    <li>
                        <a href="{{ route('blog.index', ['kategori' => $kat->id]) }}" 
                           @if($kat->id === $artikel->id_kategori) class="active" @endif>
                            <span><i class="fas fa-tag"></i> {{ $kat->nama_kategori }}</span>
                            <span class="badge">{{ $kat->artikel_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Related Articles Widget -->
        @if($terkait->count() > 0)
            <div class="sidebar-widget">
                <h5>
                    <i class="fas fa-link"></i> Artikel Terkait
                </h5>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($terkait as $related)
                        <a href="{{ route('blog.show', $related->id) }}" 
                           style="text-decoration: none; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 8px; transition: all 0.3s ease; display: block;"
                           onmouseover="this.style.backgroundColor='#f0f4ff'; this.style.borderColor='#2563eb'; this.style.transform='translateX(4px)';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#e5e7eb'; this.style.transform='translateX(0)';">
                            <div style="display: flex; gap: 0.75rem;">
                                <div style="flex-shrink: 0;">
                                    <img src="{{ asset('storage/gambar/' . $related->gambar) }}" 
                                         alt="{{ $related->judul }}"
                                         style="width: 60px; height: 60px; border-radius: 6px; object-fit: cover;"
                                         onerror="this.src='https://via.placeholder.com/60x60?text=Image'">
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 0.9rem; font-weight: 600; color: #1f2937; margin-bottom: 0.25rem; line-height: 1.3;">
                                        {{ Str::limit($related->judul, 50, '...') }}
                                    </div>
                                    <div style="font-size: 0.8rem; color: #9ca3af;">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($related->hari_tanggal)->locale('id')->translatedFormat('d M Y') }}
                                    </div>
                                    <div style="font-size: 0.8rem; color: #f59e0b; margin-top: 0.25rem;">
                                        <i class="fas fa-tag"></i> {{ $related->kategori->nama_kategori }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Author Info Widget -->
        <div class="sidebar-widget">
            <h5>
                <i class="fas fa-user-circle"></i> Tentang Penulis
            </h5>
            <div style="text-align: center;">
                <img src="{{ asset('storage/foto/' . $artikel->penulis->foto) }}" 
                     alt="{{ $artikel->penulis->nama_depan }}"
                     style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #2563eb; margin-bottom: 1rem;"
                     onerror="this.src='https://via.placeholder.com/80x80?text=Author'">
                <h6 style="font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">
                    {{ $artikel->penulis->nama_depan }} {{ $artikel->penulis->nama_belakang }}
                </h6>
                <p style="font-size: 0.9rem; color: #6b7280; margin: 0;">
                    Penulis di Aplikasi Blog dengan berbagai topik menarik.
                </p>
            </div>
        </div>

        <!-- Ads/Info Widget -->
        <div class="sidebar-widget" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white;">
            <h5 style="color: white;">
                <i class="fas fa-lightbulb"></i> Tips
            </h5>
            <p style="color: rgba(255, 255, 255, 0.9); margin: 0; font-size: 0.95rem;">
                Jangan lewatkan artikel-artikel menarik lainnya. Ikuti kami untuk mendapatkan notifikasi terbaru!
            </p>
        </div>
    </div>
</div>
@endsection