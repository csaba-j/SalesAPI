## Hogyan értelmezted a 4. pont szűrés/rendezés követelményt, és miért pont úgy döntöttél?
Általános táblázatrendezésként: Minden oszlopra növekvő-csökkenő sorrendben lehessen egy kattintással rendezni.

A szűrés kimaradt. Ha lenne még AI tokenem, megkérném, hogy csináljon szűrő funkciót, amivel minden sorban a névre tudnék szűrni, szöveges input mezőként.

A rendezésnél egyből ez jutott eszembe, szerintem standard.

A szűrés nem lett meg, idő, illetve tokenek híján - nem vagyok natív PHP-hoz szokva.
## Melyik AI modell-t használta és miért?
Kezdtem a PHPStorm beépített Claude Agent nevű funkcionalitásával aminél nem tudtam modellt választani, feltételezem Sonnet 4.6 volt nagyrészt használva, válaszai alapján tuti, hogy nem az Opus bármelyik változata.
## Hol segített az AI, hol kellett korrigálni vagy más modellt bevonni?
Docker template-szerű Dockerfile-ok és docker-compose.yaml felállításában, ki kellett javítani mert Alpine alapú image-et akart először használni.
Windows alatti Ubuntu 22.04-et (WSL) használtam, előjöttek gondok a permission-ökkel, és elérési utakkal sajnos, de megoldottam (hibaüzenetekkel kommunikáltam sima ChatGPT modellel külön.)

A Claude Agent nevű dolgot ott engedtem el, amikor JSON visszatérést kértem tőle, és tömb visszatérést írt a kódba, akkor váltottam ChatGPT Codex-re és az 5.3 Codex-el mentem tovább - ez már jóval okosabbnak bizonyult.

## Mi az, amit ha újra csinálnád, másképp csinálnál?

Ha lehetne, akkor keretrendszerben csinálnám, Symfony ismerős terep, évek óta nem kódoltam 0-ről natív PHP-ban.
Emiatt, és mivel a legutolsó bármilyennemű próbafeladatom hasonló időtávlatban volt ,amióta ugyebár az AI is szerves része lett a fejlesztésnek; nagyobb hangsúlyt fektetnék az AI promptolásra, és nem "csalásnak" érezném ezt, nem próbálnám natív PHP környezetben felhúzni a Symfony formavilágát és struktúráját, rendszerét. Elfogadnám sokkal hamarabb, hogy amit így és ezúton fogok csinálni, az nem lesz a legtisztább kód valaha, és ahelyett, hogy keretrendszert próbálok építeni fejben a 0-ról, ezt az időt a feladat konkrét megoldására fordítanám.