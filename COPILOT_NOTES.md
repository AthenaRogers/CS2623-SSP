# COPILOT_NOTES.md - CS2623 Week 1

## Accepted
- Copilot helped create the HTML5 structure for SSP01. I kept it because it matched the assignment instructions.
- Copilot suggested using require_once for the SSP02 include files. I kept it because it helps include the files needed for the page.

## Rejected
- I rejected displaying PHP output without htmlspecialchars because the assignment requires escaping output.

## Improved
- Copilot used echo $last_modified without escaping it. I changed it to use htmlspecialchars to follow the assignment instructions.

## PHP Concept Check
require() and include() both load another PHP file. The difference is that require stops the script if the file is missing, while include gives a warning and usually lets the script continue. require_once and include_once prevent the same file from being included more than once.