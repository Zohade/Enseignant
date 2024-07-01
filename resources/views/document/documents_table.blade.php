<table class="table widget-26">
    <tbody>
        @forelse ($documents as $document)
            <tr>
                <td>
                    {{-- <div class="widget-26-job-emp-img">
                        <img src="/storage/{{ $document->author->photo }}" alt="Company" />
                    </div> --}}
                </td>
                <td>
                    <div class="widget-26-job-title">
                        @if ($document->payant == 0 && !in_array(pathinfo($document->fichier, PATHINFO_EXTENSION), ['doc', 'docx']))
                            <a href="/storage/{{ $document->fichier }}" target="_blank">{{ $document->titre }}</a>
                        @else
                            <a href="{{ route('document.show', $document->id) }}"
                                target="blank">{{ $document->titre }}</a>
                        @endif
                        {{-- <p class="m-0"><a href="#" class="employer-name">{{ $document->author->name }}</a>
                            <span class="text-muted time">{{ $document->created_at }}</span>
                        </p> --}}
                    </div>
                </td>
                <td>
                    <div class="widget-26-job-info">
                        <p>{{ $document->desc }}</p>
                    </div>
                </td>
                <td>
                    <div class="widget-26-job-salary">
                        @if ($document->payant == 0)
                            Gratuit
                        @else
                            {{ number_format($document->prix, 0, '.', ' ') }} XOF
                        @endif
                    </div>
                </td>
                <td>
                    <a href="{{ route('document.download', $document->id) }}" class="bouton">
                        <svg class="svgIcon" viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8V64c0-17.7-14.3-32-32-32s-32 14.3-32 32v306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z">
                            </path>
                        </svg>
                        <span class="icon2"></span>
                        <span class="tooltip">Télécharger</span>
                    </a>
                </td>
                <td>
                    <div class="widget-26-job-starred">
                        <a href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-star">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Aucun document trouvé.</td>
            </tr>
        @endforelse
    </tbody>
</table>
