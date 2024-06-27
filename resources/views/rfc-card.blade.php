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
                    <td class="table-action"><a href="{{ $issue->link }}">View on GitHub</a></td>
                </tr>
                <tr>
                    <td>
                        <strong>Created:</strong> {{ $issue->created }}
                    </td>
                    @if($issue->updated !== $issue->created)
                        <td>
                            <strong>Updated:</strong> {{ $issue->updated }}
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
