@extends('layouts.admin')

@section('title')
  | Edit
@endsection

@section('content')

@section("jumbotron-title")
Modifica!
@endsection

@section("jumbotron-subtitle")
Puoi modificare i dettagli del tuo immobile.
@endsection


<div class="container">

  <div class="box-card-long mb-5 ">

    <div class="card-md-description d-flex justify-content-between">
      <span>Modifica: {{$apartment->title}}</span>
      <div>
        <a href="{{route('admin.apartments.index')}}" class="btn btn-primary">Torna all'elenco appartamenti</button>
        <a href="{{route('admin.home')}}" class="btn heavenly">Torna alla dashboard</a>
      </div>
    </div>

  </div>

  <div class="box-card-long ">
    <form action="{{route('admin.apartments.update', $apartment)}}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        {{-- Title --}}
      <div class="mb-3">
          <label class="form-label">Titolo</label>
          <input type="text"
          class="form-control w-75"
          value="{{ old('title', $apartment->title) }}"
          id="title"
          name="title"
          placeholder="Inserisci un titolo">
          @error('title')
            <p class="text-danger">{{ $message }}</p>
          @enderror

      </div>

      {{-- Price --}}
      <div class="mb-3">
          <label class="form-label">Prezzo</label>
          <input type="number"
          class="form-control w-75"
          value="{{ old('price', $apartment->price) }}"
          step='0.01'
          id="price"
          name="price"
          placeholder="Inserisci un titolo">
          @error('price')
            <p class="text-danger">{{ $message }}</p>
          @enderror

      </div>

      {{-- Category --}}
      <div class="mb-3">
          <label class="form-label">Categoria</label>
          <input type="text"
          class="form-control w-75"
          value="{{ old('category', $apartment->category) }}"
          id="title"
          name="category"
          placeholder="Inserisci categoria">
          @error('category')
            <p class="text-danger">{{ $message }}</p>
          @enderror

      </div>

      {{-- Address --}}
      <div class="mb-3">
          <label class="form-label">Indirizzo</label>
          <input type="text"
          class="form-control w-75"
          value="{{ old('address', $apartment->address) }}"
          id="address"
          name="address"
          placeholder="Inserisci l'indirizzo">
          @error('address')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      {{-- Cover Image --}}
      <div class="mb-3">
        <label class="form-label">Immagine di Copertina</label>
        <input type="file"
        class="form-control w-75 @error('cover_image') is-invalid @enderror"
        id="cover_image"
        name="cover_image"
        value="{{ old('cover_image', $apartment->cover_image) }}"
        placeholder="Inserisci l'indirizzo"
        onchange="showImg(event)">
        @error('cover_image')
          <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="img-preview m-5 position-relative">
          <img id="img-preview" src="{{ $src }}" alt="" width="100">
          <div class="position-absolute" id="img-clear" onclick="clearImg()"><span>X</span></div>
        </div>
      </div>

      {{-- square_meters --}}
      <div class="mb-3">
        <label class="form-label">Metri quadri</label>
        <input type="number"
        class="form-control w-75"
        value="{{ old('square_meters', $apartment->square_meters) }}"
        id="square_meters"
        name="square_meters">
        @error('square_meters')
            <p class="text-danger">{{ $message }}</p>
        @enderror
      </div>

      {{-- Number of rooms --}}
      <div class="mb-3">
          <label class="form-label">Numero stanze</label>
          <input type="number"
          class="form-control w-75"
          value="{{ old('n_rooms', $apartment->n_rooms) }}"
          id="n_rooms"
          name="n_rooms">
          @error('n_rooms')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      {{-- Number of beds --}}
      <div class="mb-3">
          <label class="form-label">Numero letti</label>
          <input type="number"
          class="form-control w-75"
          value="{{ old('n_beds', $apartment->n_beds) }}"
          id="n_beds"
          name="n_beds">
          @error('n_beds')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      {{-- Number of bathrooms --}}
      <div class="mb-3">
          <label class="form-label">Numero bagni</label>
          <input type="number"
          class="form-control w-75"
          value="{{ old('n_bathrooms', $apartment->n_bathrooms) }}"
          id="n_bathrooms"
          name="n_bathrooms">
          @error('n_bathrooms')
            <p class="text-danger">{{ $message }}</p>
          @enderror
      </div>

      <div class="mb-3">
        <h5 class="form-label">Servizi</h5>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

          <div class="d-flex flex-wrap gap-1" role="group" aria-label="Basic checkbox toggle button group">

            @foreach ($services as $service)
                <input
                  id="service{{ $loop->iteration }}"
                  class="btn-check"
                  autocomplete="off"
                  type="checkbox"
                  value="{{ $service->id }}"
                  name="services[]"

                  @if (!$errors->any() && $apartment?->services->contains($service))
                    checked
                  @elseif ($errors->any() && in_array($service->id, old('services',[])))
                    checked
                  @endif
                >
                <label class="btn btn-outline-secondary" for="service{{ $loop->iteration }}">{{ $service->name }}</label>
            @endforeach

          </div>

        </div>

      </div>


      <button type="submit" class="btn btn-primary">Conferma modifica</button>
    </form>
  </div>

</div>

  <script>
    const imgPreview = document.getElementById('img-preview');
    const imgTag = document.getElementById('cover_image');
    const imgClear = document.getElementById('img-clear');

    function showImg(e) {
      imgPreview.src = URL.createObjectURL(e.target.files[0]);
      imgClear.classList.remove('d-none');
    }

    function clearImg() {
      imgPreview.src = "http://127.0.0.1:8000/storage/uploads/img-placeholder.png";
      imgTag.value = '';
      imgClear.classList.add('d-none');
    }
  </script>

@endsection
