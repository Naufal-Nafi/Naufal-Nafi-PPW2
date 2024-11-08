@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <p><a href="{{ route('gallery.create') }}" class="btn btn-primary m-3">Tambah Gambar</a></p>
        <div class="card">
            <div class="card-header">Galeri</div>

            <div class="card-body">
                <div class="row">
                    @if (count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="col-sm-2">
                                <a class="example-image-link" href="{{ asset('storage/posts_image/' . $gallery->picture) }}"
                                    data-lightbox="roadtrip" data-title="{{ $gallery->description }}">
                                    <img class="example-image img-fluid mb-2"
                                        src="{{ asset('storage/posts_image/' . $gallery->picture) }}" alt="image-1" />

                                </a>
                                <div class="d-flex ">
                                    <p><a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-primary ">Edit</a></p>
                                    <form method="post" action="{{ route('gallery.destroy', $gallery->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin di hapus?')" type="submit"
                                            class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h5>Tidak ada data.</h5>
                    @endif
                    <div class="d-flex">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection