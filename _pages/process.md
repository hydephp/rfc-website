---
title: RFC Process
---

# The HydePHP RFC Process

## What is an RFC?

A Request for Comments (RFC) is a formal document that describes a proposed change or addition to HydePHP. 

It is used to gather feedback from the community and ensure that the proposal is thoroughly vetted before being implemented.
RFCs are particularly useful for changes that might impact workflows or require significant discussion.

## When is an RFC Needed?

Not all changes to HydePHP require an RFC. Here are some guidelines:

- **No RFC Required:** Small features, bug fixes, and new features that are unlikely to disrupt existing workflows can be directly proposed through a Pull Request (PR) or an Issue in the [HydePHP monorepo](https://github.com/hydephp/develop).
- **RFC Encouraged:** If the author seeks extensive feedback or the proposal might have a broader impact, it is recommended to mark the proposal as an RFC. This allows the community to provide input and ensures the change is carefully considered.

## How to Create an RFC

To create an RFC, follow these steps:

1. **Create a Pull Request or Issue:**
    - Go to the [HydePHP Develop](https://github.com/hydephp/develop) monorepository.
    - Create a new Pull Request or Issue with your proposal.

2. **Title and Label:**
    - Include "RFC" in the title of your Pull Request or Issue.
    - The `RFC` label is typically added automatically if "RFC" is in the title.

3. **Gather Feedback:**
    - Community members can provide feedback through comments.
    - Voting on RFCs is informal and can help gauge community support using emojis:
    - Vote `👍` for yes, `👎` for no, and `😕` for undecided.

4. **Review and Decision:**
    - Maintainers will review the RFC and consider community feedback, technical feasibility, and alignment with project goals.
    - The decision to merge the RFC will weigh community support heavily but is ultimately made by the maintainers.

## Getting Your RFC Listed on the Website

To have your RFC listed on the HydePHP RFC website (rfc.hydephp.com), please follow these steps:

1. Ensure your monorepo Pull Request or Issue is labeled with "RFC".
2. The website will automatically list all RFCs and their statuses (e.g., implemented, rejected, stale, etc.).
3. Please note that the website is built nightly using GitHub Actions, so your RFC may not appear immediately.

## Contribution Guidelines

For more detailed information on contributing to HydePHP, including etiquette, procedures, and coding standards, please refer to the [monorepo contribution guidelines](https://github.com/hydephp/develop).

---

## Additional Information

This RFC process page is part of the [HydePHP RFC Website](https://rfc.hydephp.com) which aims to provide a clear overview of all RFCs and their statuses.
The site is built nightly using GitHub Actions, and the RFC numbers correspond to GitHub issue numbers. If your RFC has not shown up within 24 hours, please reach out to the maintainers.

Additionally, there are no restrictions who can participate in the RFC process. Everyone is welcome to in good faith propose an RFC, provide constructive feedback, and vote on proposals.

If you have any questions or need assistance with creating an RFC, please reach out to the community or the maintainers. **Happy contributing!**

