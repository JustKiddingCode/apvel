APVEL
======


APVEL (AStA Protokoll Veröffentlichungs- und Editier Lösung) is a tool to write reports of meetings from organisations.
It is designed to edit simple Markdown Files and show HTML files or, if wanted PDF files.

APVEL uses EpicEditor, pandoc, smarty and PHPMailer. Thanks for writing great programs!

File structure

For each organisation there is this file structure:

REPORT/PUBLISHED/ORGANISATION/
REPORT/UNPUBLISHED/ORGANISATION/

If a published report is requested it is first converted to html and then saved in FILE.md.html (uses same file name)
UNPUBLISHED folders should have an .htaccess file to exclude users

It is possible to create git submodules for each group
