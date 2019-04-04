# Php
Php eindwerk. Het readme bestand is een bestand om zaken duidelijk in te maken.
Bijvoorbeeld de manier van klasses benoemen. Zet hier dus alle code gerelateerde specificaties.
## Stappen
Stap 1: fetch origin 🧶
Stap 2: Pull de map binnen  🥑
Stap 3: Codeer 💻
Stap 4: Commit met een duidelijke naam 🤓
Stap 5: Push 🥊

## Hacken

Als Joris in ons systeem kan hacken verliezen we -5.

### SQL-injectie

SQl typen in een bepaald veld.
Tegen gaan: real_escape_string()
BV; $email = $conn -> real_escape_string($_POST['Email']);

### XXS

Aanval op javascript
Tegen gaan: htmlspecialchars();
BV; echo htmlspecialchars($user[firstName]);

### Sniffing

Tegen gaan : https

### Bruth force

Lijst van wachtwoorden en usernames laten loopen 
Tegen gaan: 3 wachtwoord mogelijkheden 

### Databank beveiligen
(Dit doen we wel pas op het einde)
een @ symbool => @new mysqli("localhost","root", "root", "project");

