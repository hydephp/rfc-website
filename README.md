# RFC Website

https://rfc.hydephp.com/ development tree route overview

/ lists all rfc's with statuses (implemented, rejected, stale, etc) (from enum)
/process lists the process of an rfc (pr/issue in monorepo tagged with rfc (we label rfcs automatically if they have rfc in the title))
/{rfc} lists the rfc with the given number (from github)

notes:
website implemented with hydephp as static site on github pages
site is built nightly with github actions
rfc numbers are using the github issue number (hence why discussion rfcs are not valid to be considered by the website)

goals:
a simple overview of rfs's and their statuses

building: (how it's built)

1. get all issues and pull requests from the monorepo
2. filter out all issues and pull requests that are not labeled with rfc
3. get the statuses of the rfc's (implemented, rejected, stale, draft, etc)
4. create index page with all rfc's and their statuses
5. get body of rfc's from github and its comments (if any)
6. static process page from markdown
