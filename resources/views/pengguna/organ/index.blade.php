@extends('layouts.pengguna')

@section('title', 'Materi Kategori')

@section('content')
<div class="container mt-4">

    {{-- HEADER --}}
    <h4 style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e;">
        Materi: {{ $kategori->nama }}
    </h4>
    <p style="color:#7a4b63; margin-top:-5px;">
        Pilih materi yang ingin kamu pelajari
    </p>

    {{-- LIST ORGAN --}}
    <div class="row g-4 mt-3">

        @forelse($organs as $organ)
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm"
                style="border-radius:16px; border:none; background-color:#fff0f6;">

                {{-- GAMBAR --}}
                @if($organ->foto)
                <img src="{{ asset('uploads/' . $organ->foto) }}"
                    class="card-img-top"
                    style="height:180px; object-fit:cover; border-radius:16px 16px 0 0;">
                @else
                <div class="d-flex align-items-center justify-content-center"
                    style="height:180px; background-color:#ffd6e6; border-radius:16px 16px 0 0;">
                    <img src="https://img.icons8.com/fluency/96/human-organ.png" width="70">
                </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h6 style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e;">
                        {{ $organ->judul }}
                    </h6>

                    <p class="flex-grow-1" style="color:#6b4c5a; font-size:0.9rem;">
                        {{ Str::limit($organ->deskripsi, 90) }}
                    </p>

                    <a href="{{ route('pengguna.organ.show', $organ->id) }}"
                        class="btn mt-2"
                        style="background-color:#ff69b4; color:white; border-radius:10px; font-weight:600;">
                        Pelajari Materi
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center mt-5">
            <img src="https://img.icons8.com/fluency/96/nothing-found.png" width="90" class="mb-3">
            <p style="color:#8a6076; font-size:1rem;">
                Belum ada materi dalam kategori ini
            </p>
        </div>
        @endforelse

    </div>

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