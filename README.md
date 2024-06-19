# [HydePHP RFC Website](https://rfc.hydephp.com)

## Development Overview Spec

## Routes

- `/`
  Lists all RFCs with their statuses (implemented, rejected, stale, etc.) from an enum.

- `/process`
  Lists the process of an RFC (PR/issue in monorepo tagged with RFC; we label RFCs automatically if they have "RFC" in the title).

- `/{rfc}`
  Lists the RFC with the given number (sourced from GitHub).

## Notes

- The website is implemented with HydePHP as a static site on GitHub Pages.
- The site is built nightly with GitHub Actions.
- RFC numbers use the GitHub issue number.

## Goals

- Provide a simple overview of RFCs and their statuses.

## Building

1. Retrieve all issues and pull requests from the monorepo.
2. Filter out all issues and pull requests that are not labeled as RFC.
3. Determine the statuses of the RFCs (implemented, rejected, stale, draft, etc.).
4. Create an index page with all RFCs and their statuses.
5. Fetch the body of RFCs from GitHub and their comments (if any).
6. Generate a static process page from Markdown.

## Future

In the future we can render votes using `Yes: 👍 No: 👎 Undecided: 😕` emojis.
