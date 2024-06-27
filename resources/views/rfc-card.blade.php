<article>
    <header>
        <a href="{{ $issue->link }}">
            <h2>{{ $issue->prettyTitle }}</h2>
        </a>
        <table>
            <tbody>
                <tr>
                    <th>Author:</th><td>{{ $issue->author->name }}</td>
                    <th>Status:</th><td>{{ $issue->status }}</td>
                    <th>Type:</th><td>{{ $issue->type }}</td>
                    <td><a href="{{ $issue->link }}">View on GitHub</a></td>
                </tr>
                <tr>
                    <th>Created:</th><td>{{ $issue->created }}</td>
                    @if($issue->updated !== $issue->created)
                        <th>Updated:</th><td>{{ $issue->updated }}</td>
                    @endif
                </tr>
            </tbody>
        </table>
    </header>
    <p>
        {{ $issue->summary() }}
    </p>
</article>
