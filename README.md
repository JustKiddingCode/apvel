APVEL
======


APVEL (AStA Protokoll Veröffentlichungs- und Editier L) is a tool to write reports of meetings from organisations.
It is designed to edit simple Markdown Files and show HTML files or, if wanted PDF files.

APVEL uses EpicEditor and pandoc.

File structure

For each organisation WHERE is:

REPORT/ORGANISATION/PUBLISHED/
REPORT/ORGANISATION/UNPUBLISHED/

if a published report is requested it is first converted to html and then saved in FILE.md.html (uses same file name)
UNPUBLISHED folders should have an .htaccess file to exclude users

It is possible to create git submodules for each group
