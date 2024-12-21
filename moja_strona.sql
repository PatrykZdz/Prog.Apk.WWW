-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 11:49 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moja_strona`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `matka` int(11) NOT NULL DEFAULT 0,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `matka`, `nazwa`) VALUES
(1, 0, 'Buty'),
(2, 1, 'Buty do wspinaczki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(1, 'glowna', '	<table>\r\n		<tr>\r\n			<td><h2><i>Największe budynki świata</td></i></h2>\r\n		</tr>\r\n	</table>\r\n\r\n    <img src=\"img/picture1.jpg\" alt=\"Największe budyneki świata\" width=\"800\">\r\n	<br>\r\n	<b><u><h1> 5 najwyższych budynków na świecie. Oto rekordziści sięgający nieba</b></u></h1>\r\n	<p><span style=\"color: blue;\"> \r\n		\r\n		#1 Burj Khalifa w Dubaju (Zjednoczone Emiraty Arabskie)\r\n		<br>\r\n		#2 PNB 118 w Kuala Lumpur (Malezja)\r\n		<br>\r\n		#3 Shanghai Tower w Szanghaju (Chiny)\r\n		<br>\r\n		#4 Makkah Royal Clock Tower w Mekce (Arabia Saudyjska)\r\n		<br>\r\n		#5 Ping An Finance Center w Shenzhen (Chiny)\r\n	</p></span>\r\n\r\n	<h2>Definicja wieżowca</h2>\r\n	<p>\r\n        Wieżowiec to stosunkowo wysoki nadziemny budynek wolno stojący posiadający fundamenty i dach, w którym przynajmniej 50 procent jego wysokości jest wykorzystana na piętra użytkowe. To kryterium odróżnia drapacze chmur od różnego rodzaju wolno stojących wież telewizyjnych (w których piętra użytkowe to jedynie galerie widokowe i restauracje) i kominów (pojęcie piętra tu nie występuje)	</p>\r\n	<h2>Najwyższe budynki świata - jak mierzymy? </h2>\r\n	<p>\r\n		Mimo że pierwsze miejsce jest na każdej liście bezkonkurencyjne, bo monumentalny dubajski Burdż Chalifa przebija każdą możliwą pozycję nr 2 o prawie grubo ponad 100 metrów, to klasyfikacja pozostałych miejsc może być różna. Zależy czy liczymy maszty telewizyjne albo wliczamy instalacje posadowione na dachach wieżowców. Najuczciwszą jednakże klasyfikacją wydaje się ta biorąca pod uwagę budynki użytkowe i mierząca wysokość od powierzchni gruntu do ostatniego punktu strukturalnego.	</p>\r\n	\r\n	<h2>Historia drapaczy chmur, czyli opowieść o wyścigu do nieba</h2>\r\n	<p>\r\n		Tak jak zawsze człowiek chciał unieść się w powietrze, tak od wieków ambicją wielu budowniczych było wznoszenie gmachów górujących nad otoczeniem. Historia drapaczy chmur związana jest oczywiście z rewolucją przemysłową, która dała ludzkości wynalazki niezbędne do budowania wysoko. Ale dzieje niebotyków - to nie tylko szklano-stalowe konstrukcje, spopularyzowane w drugiej połowie XX wieku. W świecie wysokich budynków znaleźć można wiele innych, ciekawych historii\r\n	</p>\r\n	<div class=\"image2\">\r\n	<img src=\"img/pic2.jpg\" width=\"825\">\r\n	</div>\r\n	<div class=\"image3\">\r\n	<img src=\"img/pic3.jpg\" width=\"900\">\r\n	</div>\r\n', 1),
(2, 'budynek1', '	<title>Największe budynki świata</title>\r\n	<img src=\"img/burj-khalifa.jpeg\" alt=\"Największe budyneki świata\" width=\"400px\">\r\n	<img src=\"img/burj-khalifa3.jpeg\" width=\"250px\" >\r\n	<br>\r\n	<h1>	#1 Burj Khalifa w Dubaju (Zjednoczone Emiraty Arabskie)</h1>\r\n	<p>\r\n        Burj Khalifa w Dubaju jest obecnie najwyższym budynkiem na świecie. Ten 828-metrowy drapacz chmur znajduje się w Dubaju i mieści mieszkania, biura, pokoje hotelowe, najwyżej usytuowaną restaurację na świecie oraz najwyższy punkt widokowy. Prace budowlane nad tym zaprojektowanym przez Adriana Smitha obiektem rozpoczęły się w 2004 roku, a oficjalne otwarcie miało miejsce w 2010 roku. Od tamtej pory Burj Khalifa jest nie tylko najwyższym budynkiem na świecie, ale także tym o największej liczbie pięter. Nazwa Burj Khalifa została dedykowana Khalifie bin Zayedowi Al Nahyanowi, byłemu prezydentowi Zjednoczonych Emiratów Arabskich.	</p>\r\n	<p>\r\n	</p>\r\n	<p>\r\n		Burj Khalifa (Dubaj, Zjednoczone Emiraty Arabskie) – wysokość: 828 m. Ukończony w 2010 roku, Burj Khalifa jest najwyższym budynkiem na świecie i jednym z najbardziej rozpoznawalnych punktów orientacyjnych Dubaju. W wieżowcu o imponującej liczbie 163 pięter kryją się nie tylko biura, ale również luksusowe apartamenty oraz elegancki hotel. Ten drapacz chmur licznie odwiedza masa turystów z całego świata. Jednym z powodów odwiedzin jest zapierający dech w piersiach widok rozpościerający się z dwóch tarasów widokowych znajdujących się na 124. i 125. piętrze oraz na 148. piętrze. Bilety na taras obserwacyjny kosztują ok. 159 AED. Również w środku znajduje się restauracja, w której można zjeść posiłek na 122. piętrze. Oprócz statusu najwyższej wolnostojącej konstrukcji na świecie Burj Khalifa (Burdź Chalifa) pobił w przeszłości inne rekordy: miał najdłuższą windę i najwyżej położoną restauracją. Innym powodem odwiedzin tego giganta jest Dubai Mall – ogromne centrum rozrywkowo-gastronomiczne i centrum handlowe. Również znajdują się tutaj tańczące w rytm muzyki Fontanny Dubajskie.\r\n	</p>\r\n	<h2>\r\n		Wygląd i wystrój\r\n	</h2>\r\n	<p>\r\n		Wieżowiec Burdż Chalifa zaprojektowany został przez przedsiębiorstwo architektoniczne Skidmore, Owings and Merrill, które projektowało także budynki Willis Tower oraz 1 World Trade Center. Ogólny jego wygląd nawiązuje do kwiatu pustyni z rodzaju Hymenocallis[7] oraz architektury islamu (różne ornamenty). Budowla składa się z centralnego rdzenia oraz trzech „ramion”, które w miarę zwiększania się wysokości są coraz mniejsze, co nadaje jej smukłość. Na samym szczycie centralny rdzeń przechodzi w iglicę. Najniższe piętra przeznaczono na hotel, którego wystrojem zajął się Giorgio Armani.\r\n	</p>\r\n', 1),
(3, 'budynek2', '\r\n\r\n\r\n	<img src=\"img/PNB+118.jpg\" alt=\"Największe budyneki świata\" width=\"400\" height=\"500\">\r\n	<img src=\"img/krei4ognhxma1.jpg\" width=\"250px\">\r\n	<br>\r\n	<h1>	#2 PNB 118 w Kuala Lumpur (Malezja)</h1>\r\n	<p>\r\n		Znacznie mniejszy niż Burj Khalifa, ale nadal imponujących rozmiarów, jest PNB 118 w Kuala Lumpur, znany również jako Merdeka 118. Wieżowiec ma 679 metrów i jest drugim najwyższym budynkiem na świecie oraz najwyższym budynkiem w Azji Południowo-Wschodniej. Jego nazwa pochodzi od Permodalan Nasional Berhad (PNB), malezyjskiej spółki zarządzającej inwestycjami, która sfinansowała projekt. W PNB 118 znajdują się między innymi biura, sklepy, pokoje hotelowe i punkt widokowy.</p>\r\n	<p>\r\n		Merdeka 118 (Kuala Lumpur, Malezja) – wysokość 678,9 m. Ukończony w 2023 roku i ma 118 pięter. Wewnątrz kryją się luksusowe apartamenty, nowoczesne biura i elegancki hotel, a w planach rozbudowy przewidziane są również miejsce kultu w postaci meczetu oraz muzeum. Nazwa wieży jest nieprzypadkowa, gdyż słowo \"merdeka\" w języku malajskim oznacza \"niezależność\". Budowla powstała w miejscu, w którym uchwalono niepodległość Malezji od Wielkiej Brytanie w 1957 roku. Ten drapacz chmur będziecie mogli zobaczyć podczas wycieczki objazdowej po Malezji.\r\n	</p>\r\n	<h2>\r\n		Upamiętnienie niepodległości Malezji\r\n	</h2>\r\n	<p>\r\n		Wieża znana jest jako Merdeka 118, gdzie \"Merdeka\" oznacza w języku malajskim wolność i niepodległość. Wieżowiec Merdeka 118 ma 678,9 metrów wysokości i jest własnością PNB Merdeka Ventures Sdn Berhad.\r\n\r\nWieża Merdeka 118, posiadająca prawie 287 000 m2 powierzchni, oferuje ponad 158 000 m2 metrów kwadratowych powierzchni najmu netto dla biur w klasie premium. Na 17 ostatnich piętrach znajdzie się pierwszy i jedyny w Malezji hotel Park Hyatt. Wieża, aby zapewnić odwiedzającym niezapomniane wrażenia, oferuje unikalne funkcjonalności, takie jak „The View at 118”, najwyższy taras widokowy w Azji Południowo-Wschodniej, a także „Merdeka Boulevard at 118”, park linowy zajmujący ponad 16 000 m2 otwartej przestrzeni z zielenią i wodotryskami, do użytku publicznego. Projekt zawiera też około 8000 miejsc parkingowych.\r\n	</p>\r\n', 1),
(4, 'budynek3', '\r\n\r\n	<img src=\"img/pobrane.jpg\" alt=\"Największe budyneki świata\" width=\"400\" height=\"500\">\r\n	\r\n	<br>\r\n	<h1>	#3 Shanghai Tower w Szanghaju (Chiny)</h1>\r\n	<p>\r\n		Shanghai Tower w chińskiej metropolii Szanghaj wznosi się na wysokość 632 metrów. Jest to zdecydowanie najwyższy budynek w mieście i również najwyższy budynek w Chinach. Jednak miasto ma jeszcze więcej rekordzistów: bezpośrednio obok Shanghai Tower stoi dwunasty najwyższy budynek na świecie. Najwyższy wieżowiec w Chinach zaprojektowało amerykańskie biuro architektoniczne Gensler. Spiralna forma obiektu jest zarówno estetyczna, jak i praktyczna - zmniejsza opór wiatru.	\r\n	</p>\r\n	<img src=\"img/04.shanghai-tower.jpg\" width=\"400px\" >\r\n	<p>\r\n		Shanghai Tower (Szanghaj, Chiny) – wysokość: 632 m. Ukończony w 2015 roku, jest najwyższym budynkiem w Chinach. Ma 128 pięter i w jego wnętrzu mieszczą się apartamenty i hotel. Budynek wyróżnia się architekturą, ma skręconą podwójna warstwę wierzchnią, co ma zmniejszyć kołysania przez wiatr. W budynku również zastosowano ognioodporne windy. Przy budowie tego giganta postawiono na nowe technologie, rozwiązania ekologiczne i bezpieczeństwo. Fasada Shanghai Tower mieści 270 turbin wiatrowych, wytwarzających energię dla budynku. Deszcz i ścieki są poddawane recyklingowi w celu spłukiwania toalet i nawadniania ogrodów budynku. Ten budynek oraz wiele innych fascynujących budowli zobaczycie na jednej z naszych wycieczek objazdowych po Chinach.\r\n	</p>\r\n	<h2>\r\n		Najwyższy budynek w Chinach: Shanghai Tower\r\n	</h2>\r\n	<p>\r\n		Mimo upływu lat Shahnghai Tower wciąż jest najwyższym budynkiem wzniesionym na terytorium Chin. Jest to też najwyższy i największy budynek na świecie z certyfikatem LEED Platinum. Wieżowiec wyróżnia ponadto jeden z dwóch najwyższej na świecie usytuowanych tarasów widokowych. W dni bez smogu panoramę miasta można oglądać tu z wysokości 562 metrów (drugi tak wysoko zlokalizowany taras ma budynek Ping An Finance Center w Shenzhen). \r\n	</p>\r\n	<h2>\r\n		Charakterystyka\r\n	</h2>\r\n	<p>\r\n		Bryła budynku składa się z 9 nałożonych na siebie, walcowatych budynków otoczonych podwójną fasadą. Pierwsza warstwa fasady otacza te budynki bezpośrednio się z nimi stykając, druga stanowi zewnętrzną fasadę całej budowli. Przestrzeń pomiędzy nimi wypełniona zostanie przez dziewięć atriów[2].\r\n\r\nBudynek został tak skonstruowany, aby zmniejszyć nacisk wywierany przez wiatr, umożliwić zbieranie deszczówki celem wykorzystania jej w systemach HVAC oraz umożliwić generowanie energii przez turbiny wiatrowe. Właściciele budynku ubiegają się o certyfikację China Green Building Committee oraz U.S. Green Building Council\r\n	</p>\r\n	', 1),
(5, 'budynek4', '	<img src=\"img/pobrane2.jpeg\" alt=\"Największe budyneki świata\" width=\"400px\" height=\"500px\">\r\n	<br>\r\n	<h1>	#4 Makkah Royal Clock Tower w Mekce (Arabia Saudyjska)</h1>\r\n	<p>\r\n		Makkah Royal Clock Tower, znany również jako Abraj Al Bait, znajduje się w Mekce i ma wysokość 601 metrów. W porównaniu do innych wieżowców na tej liście wyróżnia go przede wszystkim gigantyczny zegar. Na wszystkich czterech stronach wieży zamocowane są tarcze zegarowe o średnicy 43 metrów. Zegar na Makkah Royal Clock Tower jest największym zegarem na świecie.\r\n	</p>\r\n	<p>\r\n		Makkah Royal Clock Tower (Mekka, Arabia Saudyjska) – wysokość: 601 m. Ukończony w 2012 roku, wieża zegarowa jest częścią kompleksu Abraj Al-Bait i znajduje się tuż obok Wielkiego Meczetu w Mekce. Ma 120 pięter. Mieszczą się w nim apartamenty i hotel. Na szczycie wieżowca zamontowano niedawno zegar, który stanowi największy tego typu obiekt na świecie. Zegar niemieckiej produkcji ma 43 metry wysokości i 45 metrów szerokości. Znajduje się z każdej z czterech stron budynku. Zegar jest widoczny z odległości 17 kilometrów w nocy oraz 12 kilometrów w dzień. Budynek jest nie tylko ważnym punktem orientacyjnym w Mekce, ale również ważnym miejscem zakwaterowania dla pielgrzymów przybywających do Wielkiego Meczetu. Makkah Royal Clock Tower jest częścią większego kompleksu Abraj Al-Bait, który obejmuje kilka wież, centrum handlowe, luksusowy hotel oraz muzeum. Zaplanujcie wakacje w Arabii Saudyjskiej i zobaczcie majestatyczne budowle.\r\n	</p>\r\n	<img src=\"img/1000_F_311116056_4QRtvQyHeuJbLC6yMNGo8EYSYxpEBHE5.jpg\" width=\"350px\" height=\"450px\">\r\n	<img src=\"img/mekka.jpg\" width=\"600px\" height=\"450px\" >\r\n	<h2>\r\n		Historia i Ciekawostki\r\n	</h2>\r\n	<p>\r\n		Abraj Al Bait (w wolnym tłumaczeniu Wieże Domu) powstał, aby usprawnić obsługę pielgrzymów, tak licznie przybywających do Mekki. Kompleks finansowany był przez władze Arabii Saudyjskiej. Budowa wywołała wiele kontrowersji. Aby Abraj Al Bait mógł powstać, konieczne było wyburzenie XVIII-wiecznej, otomańskiej twierdzy na szczycie wzgórza wzgórza z widokiem na Wielki Meczet.  Wybudowany kompleks (z luksusowymi hotelami, apartamentami i centrum handlowym) to drugi najdroższy obiekt na świecie - całkowity koszt budowy wyniósł 15 miliardów dolarów.\r\n\r\n		Królewska Wieża Zegarowa będzie się składać z betonowej struktury o wysokości 662 metrów oraz metalowej iglicy o wysokości 155 metrów. Te dwa elementy razem będą jedynie o 11 metrów niższe niż Burj Khalifa w Dubaju. \r\n		Gigantomiania arabskich szejków nie zna granic. Na szczycie wieżowca zamontowano niedawno zegar, który stanowi największy tego typu obiekt na świecie. Twórcy kompleksu stawiają sobie za cel zastąpienie powszechnie obowiązującego GMT (Greenwich Mean Time) przez Mecca Time, który od 11 sierpnia odmierza megakonstrukcja.\r\n\r\nZegar niemieckiej produkcji ma 43 metry wysokości i 45 metrów szerokości. Znajduje się z każdej z czterech stron budynku. Zegar jest widoczny z odległości 17 kilometrów w nocy oraz 12 kilometrów w dzień.\r\n\r\nMakkah Clock Royal Tower to także największy hotel świata. Będzie miał 76 pięter, na których znajdzie się 858 luksusowych apartamentów z widokiem na święte miejsce.\r\n	</p>', 1),
(6, 'budynek5', '\r\n	<img src=\"img/n1q3odsfxd991.jpg\" width=\"500\">\r\n	<img src=\"img/3_Ping_An_FC_(c)_Tim_Griffith.jpg\" alt=\"Największe budyneki świata\" width=\"600\" height=\"500\" >\r\n	<br>\r\n	<h1>	#5 Ping An Finance Center w Shenzhen (Chiny)</h1>\r\n	<p>\r\n		Z linii horyzontu Shenzhen wyrasta 599-metrowy drapacz chmur: Ping An Finance Center. To siedziba firmy ubezpieczeniowej Ping An Insurance, zaprojektowana przez amerykańskie biuro architektoniczne Kohn Pedersen Fox (KPF).\r\n	</p>\r\n	<p>\r\n		Ping An International Finance Centre (Shenzhen, Chiny) – wysokość: 599,1 m. Ukończony w 2017 roku, wieżowiec jest siedzibą firmy ubezpieczeniowej Ping An i liczy sobie 115 pięter. Dla jego użytkowników przygotowano 80 wind. Najszybsza z nich przemieszcza się z prędkością 10 metrów na sekundę. \r\n	</p>\r\n	<p>\r\n		Ping An Finance Center (chiń.: 平安金融中心; pinyin: Píng’ān jīnróng zhōngxīn) – wieżowiec w Shenzhen, w prowincji Guangdong, w Chińskiej Republice Ludowej. Wysokość całkowita budynku wynosi 599 m co czyni go najwyższym wieżowcem w Shenzhen i drugim co do wielkości w Chinach[1], został otwarty w 2017 roku. Stał się najwyższym wieżowcem biurowym na świecie.\r\n	</p>\r\n	<h2>\r\n		Koszty budowy\r\n	</h2>\r\n	<p>\r\n		Koszt budynku to ok. 5,49 miliarda złotych ($ 1,5 miliarda) co przy 385 918 metrach kwadratowych powierzchni użytkowej daje ok. 14225,81 złotych za metr kwadratowy.\r\n	</p>\r\n	<h2>\r\n		Informacje\r\n	</h2>\r\n	<p>\r\n		Projekt KPF dotyczący najwyższego budynku biurowego na świecie tworzy ikoniczną obecność najwyżej ocenianej na świecie marki ubezpieczeniowej i stanowi centralny element rozwijającego się miasta Shenzhen.\r\n\r\nPing An to fizyczne i kultowe centrum rozwijającej się centralnej dzielnicy biznesowej Shenzhen. Oferując ponad 100 pięter powierzchni biurowej i duże podium z powierzchnią handlową i konferencyjną, projekt łączy się również z sąsiednimi nieruchomościami komercyjnymi i mieszkalnymi oraz transportem publicznym.\r\n\r\nZ tego miejsca wznosi się kamienna i szklana wieża, która stanowi kotwicę inwestycji. Jego cztery fasady są osłonięte kamiennymi pionami w kształcie jodełki, które wystają z podstawy budynku. Na podium znajduje się pięć pięter sklepów detalicznych, które rozciągają się tarasowo od wieży, tworząc dużą przestrzeń przypominającą amfiteatr. Budynek charakteryzuje się także centralnym atrium, które służy jako publiczny przedsionek i wpuszcza światło dzienne, tworząc przyjazną przestrzeń do spotkań, zakupów i spożywania posiłków.\r\n	</p>\r\n\r\n	\r\n</body>', 1),
(7, 'budynek6', '\r\n	<div id = \"animacjaTestowa1\" class = \"test-block\">Kliknj, a się powiększy</div>\r\n		<script>\r\n			$(\"#animacjaTestowa1\").on(\"click\",function(){\r\n				$(this).animate({\r\n					width: \"500px\",\r\n					opacity: 0.4,\r\n					fontSize: \"3em\",\r\n					borderwidth: \"10px\"\r\n					\r\n\r\n				},1500);\r\n			});\r\n		</script>\r\n	<div id = \"animacjaTestowa2\" class=\"test-block\">\r\n		Najedź kursorem, a sie powiększe\r\n	</div>\r\n		<script>\r\n			$(\"#animacjaTestowa2\").on({\r\n				\"mouseover\":function() {\r\n					$(this).animate({\r\n						width:300\r\n					}, 800);\r\n			},\r\n			\"mouseout\":function() {\r\n				$(this).animate({\r\n					width:200\r\n				}, 800);\r\n			}\r\n		});\r\n		</script>\r\n	<div id=\"animacjaTestowa3\" class=\"test-block\">\r\n		Klikaj, abym urósł\r\n	</div>\r\n		<script>\r\n			$(\"#animacjaTestowa3\").on(\"click\",function(){\r\n				if (!$(this).is(\":animated\")) {\r\n					$(this).animate({\r\n						width: \"+=\" + 50,\r\n						height: \"+=\" + 10,\r\n						opacity: \"+=\" + 0.1,\r\n						duration : 3000\r\n					});\r\n				}\r\n			});\r\n		</script>\r\n\r\n	\r\n\r\n	<h1>Kontakt</h1>	\r\n	<h2>Wypełnił poniższy formularz, aby móc się z nami skontaktować</h2>\r\n	<form action=\"mailto:patryczekpatryczek@gmail.com\" method=\"post\" enctype=\"text/plain\">\r\n	<img src=\"img/email.jpg\"  width=\"400px\" >\r\n		<p> Imię: <input size=\"27\"> </p>\r\n		<p> E-mali:<input size=\"25\"></p> \r\n		<p> Temat: <input size =\"25\"></p>\r\n		<b> Wiadomość:</b> <br>\r\n		<textarea rows=\"10\" cols=\"40\" > </textarea>\r\n		<br>\r\n		<input type = \"submit\" value=\"Wyślij\">\r\n	</form>\r\n', 1),
(8, 'filmy', '<h1>Największe budynki świata</h1>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/ebD_Szbxnq4?si=FvHt16AuiEtlWiqS\" title=\"YouTube video player\" \r\nframeborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" \r\nreferrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n    \r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/r9omqwqHNiE?si=r6DvkmB94wt94YT4\" title=\"YouTube video player\" \r\nframeborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" \r\nreferrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/cZp8d0r4bjA?si=Xexup4OMIDZF7Vyh\" title=\"YouTube video player\" \r\nframeborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" \r\nreferrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>\r\n\r\n\r\n\r\n', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
