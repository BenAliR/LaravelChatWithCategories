@extends('dashboard.layouts.main')

@section('container')
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Catégories</h1>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-12" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div>

            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex"></div>

                <div style="margin: 10px !important;">
                    <a href="/dashboard/categories/create" class='btn btn-primary mb-3'><i class="bi me-2 bi-plus"></i>Ajouter une nouvelle catégorie</a>
                    <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal"><i class="bi me-2 bi-plus"></i>Ajouter une sous-catégorie</button>
                </div>
            </div>

            <!-- Add Subcategory Modal -->
            <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubcategoryModalLabel">Ajouter une sous-catégorie</h5>
                            <button type="button" class=" bg-light bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi me-2 bi-x"></i></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/dashboard/subcategories">
                                @csrf
                                <div class="mb-3">
                                    <label for="category" class="form-label">Catégorie</label>
                                    <select class="form-control" id="category" name="parent_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de la sous-catégorie</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="float: right !important;">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($categories->count())
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom de la catégorie</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td class="d-flex ">
                                        <a href="/dashboard/categories/{{ $category->slug }}/edit"><button type="button" class="btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                        <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                            @method('delete')
                                            @csrf
                                            <button class="btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @foreach ($category->subcategories as $subcategory)
                                    <tr>
                                        <td></td>
                                        <td>--- {{ $subcategory->name }}</td>
                                        <td class="d-flex ">
                                            <a href="/dashboard/categories/{{ $subcategory->slug }}/edit"><button type="button" class="btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                            <form action="/dashboard/categories/{{ $subcategory->slug }}" method="post" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                                @method('delete')
                                                @csrf
                                                <button class="btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <!-- Add pagination links -->

                        <div style="margin: 10px !important; float: right !important; ">
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    Aucune catégorie disponible.
                </div>
            @endif
        </div>
    </div>

@endsection
