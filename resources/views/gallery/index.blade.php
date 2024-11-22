@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <p><a href="{{ route('gallery.create') }}" class="btn btn-primary m-3">Tambah Gambar</a></p>
        <div class="card">
            <div class="card-header">Galeri</div>

            <!-- <div class="card-body">
                <div class="row">
                    @if (count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="col-sm-2">
                                <a class="example-image-link" href="{{ asset('storage/posts_image/' . $gallery->zpicture) }}"
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
            </div> -->

            <div class="card-body">
                <div class="row" id="gallery-container">
                    <h5 id="loading-message">Loading...</h5>
                </div>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    fetch("/api/gallery")
                        .then((response) => response.json())
                        .then((data) => {
                            const container = document.getElementById("gallery-container");
                            container.innerHTML = ""; // Clear loading message
                            if (data.status === "success" && data.data.data.length > 0) {
                                data.data.data.forEach((gallery) => {
                                    container.innerHTML += `
                            <div class="col-sm-2">
                                <a class="example-image-link" href="/storage/posts_image/${gallery.picture}" 
                                   data-lightbox="roadtrip" data-title="${gallery.description}">
                                    <img class="example-image img-fluid mb-2" 
                                         src="/storage/posts_image/${gallery.picture}" alt="${gallery.title}" />
                                </a>
                                <div class="d-flex">
                                    <p><a href="/gallery/${gallery.id}/edit" class="btn btn-primary">Edit</a></p>
                                    <form method="post" action="/gallery/${gallery.id}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button onclick="return confirm('Yakin ingin dihapus?')" 
                                                type="submit" class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>`;
                                });
                            } else {
                                container.innerHTML = "<h5>Tidak ada data.</h5>";
                            }
                        })
                        .catch((error) => {
                            console.error("Error fetching gallery:", error);
                            document.getElementById("gallery-container").innerHTML = "<h5>Error loading data.</h5>";
                        });
                });
            </script>

        </div>
    </div>
</div>





@endsection