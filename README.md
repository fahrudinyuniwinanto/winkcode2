# Winkcode 2 Framework #

Build with Codeigniter 3.1.9 + AngularJs

### Features ###

* Auth
* Access Management
* CRUD Generator include template (localhost/winkcode2/crud)
* Suport master detail form
* Lookup data

### How do I get set up? ###

* copy paste project folder
* import DB (path: assets/db/)
* setup base_url on config.php, and set your database.php 

### How to use CRUD Generator? ###
* clone winkcode 2 to your localhost
* import database on assets/db/
* login on localhost/winkcode2/auth (user: dev, pass: dev123)
* go to localhost/winkcode2/crud
* choose table want to generate
* set setting page (set caption and element field)
* generate model, controller and view
* go to localhost/winkcode2/master_access
* create master as your table (ex: tabel siswa): M_SISWA, C_SISWA, R_SISWA, U_SISWA, D_SISWA
* go to localhost/winkcode2/user_access, turn on for developer group with your access M_SISWA, C_SISWA, R_SISWA, U_SISWA, D_SISWA you have created before.
* add app menu manually on views/layout_backend.php
* lauch your new page: localhost/winkcode2/siswa
* drinking the coffe :)


### Contribution guidelines ###

* Free to use (dont remove watermark on footerpage)

Thanks for contributing
### Documentation buka <a href="https://www.youtube.com/watch?v=HWhyPSOJ1p4" target="_blank">link ini</a> ###



