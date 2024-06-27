<article>
    <header>
        <a href="{{ $issue->link }}">
            <h2>{{ $issue->prettyTitle }}</h2>
        </a>
        <table>
            <tbody>
                <tr>
                    <td>
                        <strong>Status:</strong> <span class="{{ $issue->status->color() }}">{{ $issue->status }}</span>
                    </td>
                    <td>
                        <strong>Author:</strong> {{ $issue->author->name }}
                    </td>
                    <td>
                        <strong>Created:</strong> {{ (new \App\Types\CarbonDate($issue->createdAt))->toShortHtml() }}
                    </td>
                    @if($issue->updated !== $issue->created)
                        <td>
                            <strong>Updated:</strong> {{ (new \App\Types\CarbonDate($issue->updatedAt))->toShortHtml() }}
                        </td>
                    @endif
                    <td>
                        <strong>Source:</strong> <a href="{{ $issue->github() }}" rel="nofollow" target="_blank">{{ $issue->type->shortName() }} #{{ $issue->number }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </header>
    <p class="summary">
        {{ $issue->summary() }}
    </p>
</article>
