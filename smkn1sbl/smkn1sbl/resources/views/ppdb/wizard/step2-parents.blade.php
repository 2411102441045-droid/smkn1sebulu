@extends('layouts.public')

@section('title', 'Pendaftaran — Data Orang Tua')

@section('content')

    @include('ppdb.wizard._progress', ['currentStep' => 2])

    <section class="max-w-3xl mx-auto px-6 py-10">
        <h1 class="font-display font-extrabold text-2xl text-slate-800 mb-1">Data Orang Tua / Wali</h1>
        <p class="text-sm text-slate-500 mb-6">Langkah 2 dari 7 — isi data orang tua atau wali calon siswa.</p>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm px-5 py-4">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ppdb.wizard.parents.store') }}" method="POST" class="bg-white rounded-2xl border border-skblue-100 p-6 md:p-8 space-y-4">
            @csrf

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Ayah</label>
                    <input type="text" name="father_name" value="{{ $old['father_name'] ?? old('father_name') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>
                 <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama Ibu</label>
                    <input type="text" name="mother_name" value="{{ $old['mother_name'] ?? old('mother_name') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>

                 <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Pekerjaan Ayah</label>
                    <input type="text" name="father_occupation" value="{{ $old['father_occupation'] ?? old('father_occupation') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>
                 <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">Pekerjaan Ibu</label>
                    <input type="text" name="mother_occupation" value="{{ $old['mother_occupation'] ?? old('mother_occupation') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP Ayah</label>
                    <input type="text" name="father_phone" value="{{ $old['father_phone'] ?? old('father_phone') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>
               
               
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1.5">No. HP Ibu</label>
                    <input type="text" name="mother_phone" value="{{ $old['mother_phone'] ?? old('mother_phone') }}"
                           class="w-full rounded-xl border border-skblue-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-skblue-400 focus:outline-none">
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <a href="{{ route('ppdb.wizard.biodata') }}"
                   class="rounded-xl border border-skblue-200 text-skblue-700 font-semibold px-6 py-3.5 hover:bg-skblue-50 transition">
                    ← Kembali
                </a>
                <button type="submit"
                        class="flex-1 rounded-xl bg-skblue-600 hover:bg-skblue-700 hover:-translate-y-0.5 hover:shadow-lg text-white font-bold py-3.5 shadow-md transition-all duration-200">
                    Lanjut ke Upload Dokumen →
                </button>
            </div>
        </form>
    </section>

@endsection
