APVEL
======


APVEL (AStA Protokoll Veröffentlichungs- und Editier Lösung) is a tool to write reports of meetings from organisations.
It is designed to edit simple Markdown Files and show HTML files or, if wanted PDF files.

APVEL uses EpicEditor, pandoc, smarty, and PHPMailer. Thanks for writing great programs!
For authentification, connectors to DokuWiki is implemented.

File structure

For each organisation there is this file structure:

REPORT/PUBLISHED/ORGANISATION/
REPORT/UNPUBLISHED/ORGANISATION/

You can send e-mails from the editor, and configure apvel to write an email by publishing a report.

Published reports are available in different formats. By now, pdf, markdown and html are supported.
UNPUBLISHED folders should have an .htaccess file to exclude users or the server should prevent this (nginx)

APVEL in Use
------------

![](https://raw.githubusercontent.com/JustKiddingCode/apvel/master/doc/screenshot/invitation.png)
![](https://raw.githubusercontent.com/JustKiddingCode/apvel/master/doc/screenshot/organ_selector.png)
![](https://raw.githubusercontent.com/JustKiddingCode/apvel/master/doc/screenshot/overview.png)
![](https://raw.githubusercontent.com/JustKiddingCode/apvel/master/doc/screenshot/using_epiceditor.png)

