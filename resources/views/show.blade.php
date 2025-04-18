<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Livre - {{ $livre->titre }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-cover {
            max-width: 300px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .details-card {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card details-card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Détails du Livre</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($livre->image)
                                    <img src="{{ asset('storage/'.$livre->image) }}" 
                                         alt="Couverture de {{ $livre->titre }}" 
                                         class="book-cover img-fluid mb-4" style="max-width: 100%; height: auto;">
                                @else
                                    <div class="bg-light p-5 text-center text-muted mb-4">
                                        <i class="fas fa-book fa-5x mb-3"></i>
                                        <p>Aucune image disponible</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h3 class="mb-3">{{ $livre->titre }}</h3>
                                
                                <div class="mb-3">
                                    <h5 class="d-inline">Auteur:</h5>
                                    <span class="fs-5 ms-2">{{ $livre->auteur ?? 'Non spécifié' }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <h5 class="d-inline">Pages:</h5>
                                    <span class="fs-5 ms-2">{{ $livre->pages }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <h5 class="d-inline">Année de publication:</h5>
                                    <span class="fs-5 ms-2">{{ $livre->annee_publication ?? 'Non spécifiée' }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <h5 class="d-inline">Catégorie:</h5>
                                    <span class="badge bg-info fs-6 ms-2">{{ $livre->categorie->nom }}</span>
                                </div>
                                
                                <div class="mt-4">
                                    <h5>Description:</h5>
                                    <p class="lead">{{ $livre->description ?? 'Aucune description disponible' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('livres.index') }}" class="btn btn-secondary back-btn">
                                        <i class="fas fa-arrow-left me-2"></i> Retour à la liste
                                    </a>
                                    <div class="btn-group">
                                        <a href="{{ route('livres.edit', $livre->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i> Modifier
                                        </a>
                                        <form action="{{ route('livres.destroy', $livre->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ms-2" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?')">
                                                <i class="fas fa-trash-alt me-2"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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