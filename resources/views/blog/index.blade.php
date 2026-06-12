@extends('blog.layouts.app')

@section('title', isset($selectedCategory) ? $selectedCategory->nama_kategori : 'Semua Artikel')

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Category Header -->
        @if(isset($selectedCategory))
            <div style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);">
                <h2 style="margin: 0; font-weight: 700;">
                    <i class="fas fa-tag"></i> {{ $selectedCategory->nama_kategori }}
                </h2>
                @if($selectedCategory->keterangan)
                    <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">{{ $selectedCategory->keterangan }}</p>
                @endif
            </div>
        @else
            <div style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);">
                <h2 style="margin: 0; font-weight: 700;">
                    <i class="fas fa-newspaper"></i> Semua Artikel Terbaru
                </h2>
                <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Baca artikel menarik dari penulis kami</p>
            </div>
        @endif

        <!-- Articles Grid -->
        @if($artikel->count() > 0)
            <div class="row">
                @foreach($artikel as $item)
                    <div class="col-md-6 mb-4" style="display: flex;">
                        <div class="article-card w-100">
                            <div class="article-image">
                                <img src="{{ asset('storage/gambar/' . $item->gambar) }}" 
                                     alt="{{ $item->judul }}"
                                     onerror="this.src='https://via.placeholder.com/400x200?text=No+Image'">
                            </div>
                            <div class="card-body">
                                <span class="article-category">{{ $item->kategori->nama_kategori }}</span>
                                <a href="{{ route('blog.show', $item->id) }}" class="article-title">
                                    {{ $item->judul }}
                                </a>
                                <p class="article-excerpt">
                                    {{ Str::limit(strip_tags($item->isi), 100, '...') }}
                                </p>
                                <div class="article-meta">
                                    <div class="author-info">
                                        <img src="{{ asset('storage/foto/' . $item->penulis->foto) }}" 
                                             alt="{{ $item->penulis->nama_depan }}"
                                             class="author-avatar"
                                             onerror="this.src='https://via.placeholder.com/28x28?text=Author'">
                                        <span>{{ $item->penulis->nama_depan }} {{ $item->penulis->nama_belakang }}</span>
                                    </div>
                                    <span>
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ \Carbon\Carbon::parse($item->hari_tanggal)->locale('id')->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $artikel->links() }}
            </div>
        @else
            <div class="no-articles">
                <i class="fas fa-inbox"></i>
                <h5 class="mt-3 mb-2">Tidak Ada Artikel</h5>
                <p>Belum ada artikel yang dipublikasikan untuk kategori ini.</p>
                @if(isset($selectedCategory))
                    <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm mt-3" style="background: #2563eb; border: none;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Semua Artikel
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Categories Widget -->
        <div class="sidebar-widget">
            <h5>
                <i class="fas fa-folder-open"></i> Kategori
            </h5>
            @if($kategori->count() > 0)
                <ul class="category-list">
                    <li>
                        <a href="{{ route('blog.index') }}" @if(!isset($selectedCategory)) class="active" @endif>
                            <span><i class="fas fa-list"></i> Semua Artikel</span>
                            <span class="badge">{{ $artikel->total() ?? 0 }}</span>
                        </a>
                    </li>
                    @foreach($kategori as $kat)
                        <li>
                            <a href="{{ route('blog.index', ['kategori' => $kat->id]) }}" 
                               @if(isset($selectedCategory) && $selectedCategory->id === $kat->id) class="active" @endif>
                                <span><i class="fas fa-tag"></i> {{ $kat->nama_kategori }}</span>
                                <span class="badge">{{ $kat->artikel_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted text-center" style="padding: 1rem 0;">Belum ada kategori</p>
            @endif
        </div>

        <!-- Info Widget -->
        <div class="sidebar-widget">
            <h5>
                <i class="fas fa-info-circle"></i> Tentang Blog
            </h5>
            <p style="color: #6b7280; font-size: 0.95rem; margin: 0;">
                Platform berbagi artikel dan cerita menarik dari penulis berbakat. Temukan inspirasi dan pengetahuan baru setiap harinya.
            </p>
        </div>

        <!-- Latest Articles Widget -->
        <div class="sidebar-widget">
            <h5>
                <i class="fas fa-star"></i> Populer
            </h5>
            @php
                $popularArticles = \App\Models\Artikel::with('kategori', 'penulis')
                    ->orderBy('id', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            @if($popularArticles->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($popularArticles as $popular)
                        <a href="{{ route('blog.show', $popular->id) }}" 
                           style="text-decoration: none; padding: 0.75rem; border-left: 3px solid #2563eb; padding-left: 1rem; transition: all 0.3s ease; border-radius: 4px;"
                           onmouseover="this.style.backgroundColor='#f0f4ff'; this.style.transform='translateX(4px)';"
                           onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateX(0)';">
                            <div style="font-size: 0.9rem; font-weight: 600; color: #1f2937; margin-bottom: 0.25rem;">
                                {{ Str::limit($popular->judul, 60, '...') }}
                            </div>
                            <div style="font-size: 0.8rem; color: #9ca3af;">
                                <i class="fas fa-calendar-alt"></i>
                                {{ \Carbon\Carbon::parse($popular->hari_tanggal)->locale('id')->translatedFormat('d M Y') }}
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection