NUSAF LAME_ARANG - CRUD PHP

1. Copy folder nusaflame_arang ke htdocs.
2. Jalankan Apache dan MySQL di XAMPP.
3. Buka phpMyAdmin lalu import nusaflame_arang.sql.
4. Pastikan config/database.php memakai username/password MySQL kamu.
5. Buka:
   http://localhost/nusaflame_arang/
6. Untuk membuat admin pertama:
   http://localhost/nusaflame_arang/auth/buat_admin.php
7. Setelah admin dibuat, login melalui:
   http://localhost/nusaflame_arang/auth/login.php

Catatan:
- Password admin disimpan menggunakan password_hash().
- Gambar produk maksimal 3 MB.
- Format gambar: JPG, JPEG, PNG, WEBP.
