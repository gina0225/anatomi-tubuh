@extends('layouts.pengguna')

@section('title', 'Pelajari Materi')

@section('content')
<div class="container mt-4">

    {{-- JUDUL --}}
    <h3 class="mt-3" style="font-family:'Poppins', sans-serif; font-weight:700; color:#4a0d2e;">
        {{ $organ->judul }}
    </h3>

    {{-- ========== PEMOTONGAN OTOMATIS DESKRIPSI ========== --}}
    @php
    // ambil teks
    $text = $organ->deskripsi ?? '';

    // total karakter (UTF-8 safe)
    $total = mb_strlen($text);
    if ($total === 0) {
        $bagian1 = '';
        $bagian2 = '';
    } else {
        // titik tengah kasar
        $mid = intval($total / 2);

        // potongan awal sampai mid (UTF-8)
        $firstChunk = mb_substr($text, 0, $mid);

        // cari spasi terakhir dalam firstChunk (gunakan byte-safe karena spasi ascii)
        $lastSpace = strrpos($firstChunk, ' ');

        if ($lastSpace !== false) {
            // jika ada spasi sebelum mid -> potong di situ (menghindari memotong kata)
            $splitPos = $lastSpace;
        } else {
            // kalau tidak ada spasi sebelumnya, cari spasi pertama setelah mid
            $after = mb_substr($text, $mid);
            $nextSpace = strpos($after, ' ');
            if ($nextSpace !== false) {
                $splitPos = $mid + $nextSpace;
            } else {
                // fallback: potong di tengah kalau tidak ditemukan spasi sama sekali
                $splitPos = $mid;
            }
        }

        // ambil dua bagian (trim agar tidak ada spasi awal/akhir yang berlebih)
        $bagian1 = rtrim(mb_substr($text, 0, $splitPos));
        $bagian2 = ltrim(mb_substr($text, $splitPos));
    }
@endphp
    {{-- ===================================================== --}}

    {{-- LAYOUT MIRIP JURNAL --}}
<div class="mt-4 p-3"
     style="
        background:#fff0f6;
        border-radius:16px;
        color:#6b4c5a;
        font-size:1rem;
        line-height:1.5;
     ">
    
    <div class="row">
        
        {{-- KOLOM KIRI --}}
        <div class="col-md-6" style="text-align: justify;">
            
            {{-- FOTO --}}
            @if($organ->foto)
                <img src="{{ asset('uploads/' . $organ->foto) }}"
                    class="img-fluid mb-3"
                    style="
                        border-radius:200px;
                        width:50%;
                        object-fit:cover;
                        display:block;
                        margin-left:auto;
                        margin-right:auto;
                    ">
            @else
                <div class="d-flex align-items-center justify-content-center mb-3"
                    style="height:220px; background-color:#ffd6e6; border-radius:12px;">
                    <img src="https://img.icons8.com/fluency/96/human-organ.png" width="90">
                </div>
            @endif

            {{-- DESKRIPSI BAGIAN 1 --}}
            <div>
                {!! nl2br(e($bagian1)) !!}
            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-md-6" style="text-align: justify;">

            {{-- DESKRIPSI BAGIAN 2 --}}
            <div>
                {!! nl2br(e($bagian2)) !!}
            </div>

        </div>

    </div>

</div>



    {{-- INFORMASI TAMBAHAN --}}
    @if($informasi->count())
    <h5 class="mt-4" style="font-family:'Poppins'; font-weight:600; color:#4a0d2e;">
        Informasi Tambahan
    </h5>

    @foreach($informasi as $info)
    <div class="p-3 mt-2"
        style="background:#ffe6f2; border-radius:12px; color:#6b4c5a;">
        <strong>{{ $info->judul }}</strong>
        <p class="mt-1 mb-0">{!! nl2br(e($info->deskripsi)) !!}</p>
    </div>
    @endforeach
    @endif

    {{-- 🔻 TOMBOL KEMBALI (FLOATING, KANAN BAWAH) --}}
<div class="d-flex justify-content-end mt-5 mb-4">
    <a href="{{ url()->previous() }}"
        style="
            background-color:#ffe6f0;
            padding:12px 20px;
            border-radius:14px;
            color:#b03060;
            font-weight:600;
            text-decoration:none;
            box-shadow:0 4px 10px rgba(0,0,0,0.15);
            transition:0.2s;
        "
        onmouseover="this.style.transform='scale(1.05)'"
        onmouseout="this.style.transform='scale(1)'"
    >
        Kembali
    </a>
</div>

@endsection
