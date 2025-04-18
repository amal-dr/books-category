<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre - {{ $livre->titre }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .book-cover {
            max-height: 200px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-form {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-form">
                    <div class="card-header bg-warning text-dark">
                        <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier le Livre</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('livres.update', $livre->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Titre -->
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" class="form-control" value="{{ old('titre', $livre->titre) }}" required>
                            </div>

                            <!-- Auteur -->
                            <div class="mb-3">
                                <label for="auteur" class="form-label">Auteur</label>
                                <input type="text" name="auteur" class="form-control" value="{{ old('auteur', $livre->auteur) }}">
                            </div>

                            <!-- Pages -->
                            <div class="mb-3">
                                <label for="pages" class="form-label">Nombre de Pages</label>
                                <input type="number" name="pages" class="form-control" value="{{ old('pages', $livre->pages) }}" required>
                            </div>

                            <!-- Année de publication -->
                            <div class="mb-3">
                                <label for="annee_publication" class="form-label">Année de Publication</label>
                                <input type="text" name="annee_publication" class="form-control" value="{{ old('annee_publication', $livre->annee_publication) }}">
                            </div>

                            <!-- Catégorie -->
                            <div class="mb-3">
                                <label for="categorie_id" class="form-label">Catégorie</label>
                                <select name="categorie_id" class="form-select" required>
                                    <option value="">-- Choisissez une catégorie --</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $livre->categorie_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="4">{{ old('description', $livre->description) }}</textarea>
                            </div>

                            <!-- Image actuelle -->
                            <div class="mb-3">
                                <label class="form-label">Image actuelle</label><br>
                                @if($livre->image)
                                    <img src="{{ asset('storage/' . $livre->image) }}" alt="Image actuelle" class="book-cover mb-3">
                                @else
                                    <div class="text-muted">Aucune image</div>
                                @endif
                            </div>

                            <!-- Nouvelle image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Changer l'image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('livres.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-2"></i> Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
