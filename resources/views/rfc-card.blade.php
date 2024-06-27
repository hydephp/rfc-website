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
                        <strong>Type:</strong> {{ $issue->type }}
                    </td>
                    <td class="table-action"><a href="{{ $issue->github() }}">View on GitHub</a></td>
                </tr>
                <tr>
                    <td>
                        <strong>Created:</strong> {{ (new \App\Types\CarbonDate($issue->createdAt))->toHtml(true) }}
                    </td>
                    @if($issue->updated !== $issue->created)
                        <td>
                            <strong>Updated:</strong> {{ (new \App\Types\CarbonDate($issue->updatedAt))->toHtml(true) }}
                        </td>
                    @endif
                    <td class="mobile-table-action"><a href="{{ $issue->link }}">View on GitHub</a></td>
                </tr>
            </tbody>
        </table>
    </header>
    <p>
        {{ $issue->summary() }}
    </p>
</article>
