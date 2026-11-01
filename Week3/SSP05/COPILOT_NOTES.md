
# COPILOT_NOTES.md - CS 2623 Week 1

## Accepted

- I accepted the HTML5 doctype, charset, and viewport metadata after checking that they matched the assignment requirements.
- I accepted the PHP loop structure for generating the seven planner rows after verifying the starting value, stopping condition, and increment.

## Rejected

- I rejected any suggestion to echo dynamic data directly without htmlspecialchars().
  I used htmlspecialchars() with ENT_QUOTES and UTF-8 for dynamic output to meet the assignment's security requirement.

## Improved

- I checked the generated timestamp code and used filemtime($_SERVER["SCRIPT_FILENAME"]) to obtain the modification time of the requested PHP script.
  I escaped the displayed timestamp using htmlspecialchars($last_modified, ENT_QUOTES, "UTF-8").

## require() and include()

- I used Copilot Chat to explain the difference between require() and include().
  I verified the explanation against the textbook before using it.
