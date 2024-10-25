@php
  $foto_bg = get_section_data('Gambar Background');
  $foto_kelulusan = get_section_data('Gambar Profil Kelulusan');
  $nama_website = get_setting_value('_nama_website');
  $judul_web = get_setting_value('_site_name');
  $subjudul1 = get_setting_value('_subjudul1');
  $subjudul2 = get_setting_value('_subjudul2');
  $narasi1 = get_setting_value('_narasi1');
  $narasi2 = get_setting_value('_narasi2');
  $nama = get_header_value('_nama');
  $deskripsi = get_header_value('_deskripsi');
@endphp


@extends('layout.template')

@section('title')
SIMPEL - Profil Lulusan
@endsection

@section('content')

{{-- Awal Carousel --}}
<div
  class="hero lg:min-h-screen md:h-52 sm:h-40 w-full"
  style="background-image: url('{{ Storage::url($foto_bg->foto) }}');">
  <div class="hero-overlay bg-opacity-60"></div>
  <div class="hero-content text-neutral-content text-center">
    <div class=" max-w-xl">
      <h1 class="mb-3 text-2xl md:text-4xl lg:text-5xl font-bold text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{ $nama_website }}</h1>
      <h3 class="mb-5 text-xl md:text-2xl lg:text-3xl font-bold text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">{{$judul_web}}</h3>
      <a href="https://sipil.unimal.ac.id/" target="_blank" class="btn btn-success text-white hover:bg-white hover:text-black" data-aos="fade-down" data-aos-duration="2000" data-aos-delay="200">Cek Website</a>
    </div>
  </div>
</div>
  {{-- Akhir Carousel --}}

  {{-- Awal Narasi --}}
  <div class="container mx-auto mt-8 overflow-hidden">
    <div class="flex flex-col-reverse md:flex-row items-center md:items-start mb-4">
      <div class="w-24 h-1 bg-green-600 md:ms-12 mb-4 mt-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200"></div>
      <h1 id="narasi1" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold ms-4 md:ms-0 text-slate-800 text-center md:text-left" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">{{ $subjudul1 }}</h1>
    </div>
    <div class="sm:text-sm md:text-base lg:text-base mx-12 mb-2 leading-relaxed text-slate-800 text-justify" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">{!! $narasi1 !!}</div> 
  </div>
  {{-- Akhir Narasi --}}

  {{-- Awal Profil Lulusan --}}
  <div class="container mx-auto mt-8 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <!-- Header Section -->
    <div class="flex flex-col-reverse md:flex-row-reverse items-center md:items-start">
      <div class="w-24 h-1 md:w-24 bg-green-600 md:me-12 mb-4 mt-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200"></div>
      <h1 id="narasi2" class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold me-0 md:me-4 text-slate-800 text-center md:text-left" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">{{ $subjudul2 }}</h1>
    </div>
  
    <!-- Image and Text Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 mt-8 gap-4">
      <img
        src="{{ Storage::url($foto_kelulusan->foto) }}"
        alt="profil" class="mx-auto md:w-full lg:w-10/12 xl:max-w-screen-lg rounded-lg" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200"/>
  
      <div class="flex flex-col mx-4 sm:mx-6 md:mx-0">
        <div class="sm:text-sm md:text-base lg:text-base leading-relaxed text-slate-800 text-justify" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          {!! $narasi2 !!}
        </div>
      </div>
    </div>
  
    <!-- Table Section -->
    <div class="overflow-x-auto mt-8 max-w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg mx-auto">
      <table class="w-full table-auto border-collapse border-spacing-2 border border-slate-700" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
        <!-- Head -->
        <thead class="bg-gray-200">
          <tr class="text-black text-sm md:text-base lg:text-lg">
            <th class="border border-slate-700 text-base sm:text-sm md:text-base lg:text-lg">No</th>
            <th class="border border-slate-700 text-base sm:text-sm md:text-base lg:text-lg">{{$nama}}</th>
            <th class="border border-slate-700 text-base sm:text-sm md:text-base lg:text-lg">{{$deskripsi}}</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 1; @endphp
          @foreach (get_profile()->take(5) as $profile)
          <tr class="text-slate-800 bg-green-300 hover:bg-green-600 hover:text-white">
            <th class="content-start py-4 border border-slate-700 px-2">{{ $no++ }}</th>
            <td class="content-start  py-4 border border-slate-700 px-2 font-medium">{!! $profile->nama_profil !!}</td>
            <td class="border border-slate-700 px-2 py-1 font-medium leading-relaxed">{!! $profile->deskripsi_profil !!}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  
  {{-- Akhir Profil Lulusan --}}
@endsection