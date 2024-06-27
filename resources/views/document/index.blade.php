    @include('template.menu')
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">


        <title>Documents</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/document.css') }}">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card search-form">
                        <div class="card-body p-0">
                            <form id="search-form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row no-gutters">
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Type</option>
                                                    <option>Guides</option>
                                                    <option>Fiches</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                                <input type="text" placeholder="Rechercher..." class="form-control"
                                                    id="search" name="search">
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-base">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65"
                                                            y2="16.65">
                                                        </line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="search-result">
                                        <div class="result-header">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="records">Voir: <b>{{ $n }}</b> des <b>200</b>
                                                        resultats
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="result-actions">
                                                        <div class="result-sorting">
                                                            <span>Trier par:</span>
                                                            <select class="form-control border-0" id="exampleOption">
                                                                <option value="1">Plus téléchargés</option>
                                                                <option value="2">Par classe</option>
                                                                <option value="3">Plus récents</option>
                                                                <option value="4">Plus anciens</option>
                                                            </select>
                                                        </div>
                                                        <div class="result-views">
                                                            <button type="button" class="btn btn-soft-base btn-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-list">
                                                                    <line x1="8" y1="6" x2="21"
                                                                        y2="6"></line>
                                                                    <line x1="8" y1="12" x2="21"
                                                                        y2="12"></line>
                                                                    <line x1="8" y1="18" x2="21"
                                                                        y2="18"></line>
                                                                    <line x1="3" y1="6" x2="3"
                                                                        y2="6"></line>
                                                                    <line x1="3" y1="12" x2="3"
                                                                        y2="12"></line>
                                                                    <line x1="3" y1="18" x2="3"
                                                                        y2="18"></line>
                                                                </svg>
                                                            </button>
                                                            <button type="button" class="btn btn-soft-base btn-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-grid">
                                                                    <rect x="3" y="3" width="7" height="7">
                                                                    </rect>
                                                                    <rect x="14" y="3" width="7" height="7">
                                                                    </rect>
                                                                    <rect x="14" y="14" width="7" height="7">
                                                                    </rect>
                                                                    <rect x="3" y="14" width="7" height="7">
                                                                    </rect>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">
                                                <table class="table widget-26">
                                                    <tbody>
                                                        @foreach ($documents as $key => $document)
                                                            <tr>
                                                                <td>
                                                                    <div class="widget-26-job-emp-img">
                                                                        <img src="/storage/{{ $document->author->photo }}"
                                                                            alt="Company" />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-title">
                                                                        @if (
                                                                            $document->payant == 0 &&
                                                                                pathinfo($document->fichier, PATHINFO_EXTENSION) !== 'doc' &&
                                                                                pathinfo($document->fichier, PATHINFO_EXTENSION) !== 'docx')
                                                                            <a href="/storage/{{ $document->fichier }}"
                                                                                target="_blank">{{ $document->titre }}</a>
                                                                        @else
                                                                            <a href="{{ route('document.show', $document->id) }}"
                                                                                target="blank">{{ $document->titre }}</a>
                                                                        @endif
                                                                        <p class="m-0"><a href="#"
                                                                                class="employer-name">{{ $document->author->name }}</a>
                                                                            <span
                                                                                class="text-muted time">{{ $document->createAt }}
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-info">
                                                                        <p> {{ $document->desc }}</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-salary">
                                                                        @if ($document->payant == 0)
                                                                            Gratuit
                                                                        @else
                                                                            {{ number_format($document->prix, 0, '.', ' ') }}
                                                                            XOF
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button class="bouton">
                                                                        <svg class="svgIcon" viewBox="0 0 384 512"
                                                                            height="1em"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z">
                                                                            </path>
                                                                        </svg>
                                                                        <span class="icon2"></span>
                                                                        <span class="tooltip">Télécharger</span>
                                                                    </button>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-starred">
                                                                        <a href="#">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="feather feather-star">
                                                                                <polygon
                                                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                                </polygon>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        {{-- <td>
                                                                <div class="widget-26-job-starred">
                                                                    <a href="#">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            stroke="currentColor" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            class="feather feather-star starred">
                                                                            <polygon
                                                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                            </polygon>
                                                                        </svg>
                                                                    </a>
                                                                </div>
                                                            </td> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav class="d-flex justify-content-center">
                                <ul class="pagination pagination-base pagination-boxed pagination-square mb-0">
                                    <li class="page-item">
                                        <a class="page-link no-border" href="#">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link no-border" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link no-border" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link no-border" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link no-border" href="#">4</a></li>
                                    <li class="page-item">
                                        <a class="page-link no-border" href="#">
                                            <span aria-hidden="true">»</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"></script>
    </body>

    </html>
