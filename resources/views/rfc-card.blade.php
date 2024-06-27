<article>
    <header>
        <a href="{{ $issue->link }}">
            <h2>{{ $issue->prettyTitle }}</h2>
        </a>
        <table>
            <tbody>
                <tr>
                    <td>
                        <strong>Author:</strong> {{ $issue->author->name }}
                    </td>
                    <td>
                        <strong>Status:</strong> {{ $issue->status }}

                    </td>
                    <td>
                        <strong>Source:</strong> <a href="{{ $issue->github() }}" rel="nofollow" target="_blank">{{ $issue->type }} #{{ $issue->number }}</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Created:</strong> {{ (new \App\Types\CarbonDate($issue->createdAt))->toShortHtml() }}
                    </td>
                    @if($issue->updated !== $issue->created)
                        <td>
                            <strong>Updated:</strong> {{ (new \App\Types\CarbonDate($issue->updatedAt))->toShortHtml() }}
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </header>
    <p>
        {{ $issue->summary() }}
    </p>
</article>
