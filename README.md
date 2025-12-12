## Főbb funkciók

- **Felhasználói autentikáció**
  - Regisztráció és bejelentkezés a Laravel alap auth rendszerével
- **Események kezelése**
  - Események létrehozása, módosítása és törlése (soft delete)
  - Csak a saját eseményeiket tudják a felhasználók szerkeszteni/törölni
- **Feliratkozás eseményekre**
  - Egy felhasználó csak egyszer jelentkezhet ugyanarra az eseményre

- **Kártya nézet**
  - Az események kártya nézetben jelennek meg, a kép, név, dátum és státusz információkkal
- **Navigáció**
  - Login/Regisztráció gomb ha nincs bejelentkezve
  - Kilépés és „+ Új esemény” gomb ha be van jelentkezve
 
  
- `EventController.php` – Események CRUD és feliratkozás logika
- `Event.php` – Esemény modell, kapcsolatok a `User` és `EventRegistration` modellel
- `EventRegistration.php` – Kapcsolótábla a feliratkozásokhoz (`event_id`, `user_id`)

- `EventCard.vue` – Események kártya nézete, tartalmazza:
- „Jelentkezem"  gomb logikát
- Saját események esetén „Módosítás” és „Törlés” gombokat
- `Index.vue` – Lista oldal, grid nézet, login/logout gombok, „+ Új esemény” gomb
