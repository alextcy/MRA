-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2014 at 06:19 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mra`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `avatar` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `avatar`) VALUES
(1, 'Гоша Берлинский', ''),
(2, 'Алекс Экслер', 'exler.jpg'),
(3, 'Роман Корнеев', ''),
(4, 'Нина Цыркун', ''),
(5, 'Марианна Симонова', ''),
(6, 'Кирилл Илюхин', '');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `name_native` varchar(250) NOT NULL,
  `poster` varchar(250) NOT NULL,
  `release_year` year(4) NOT NULL,
  `description` text NOT NULL,
  `alias` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `name`, `name_native`, `poster`, `release_year`, `description`, `alias`) VALUES
(1, 'Одинокий рейнджер', 'The Lone Ranger', 'lone-ranger.jpg', 2013, 'История блюстителя закона Джона Рида, который с помощью индейца Тонто стал легендарным мстителем в маске, стоящим на защите справедливости. Тонто с юмором и небылицами повествует о тех приключениях, которые пришлось пережить двум непохожим друг на друга героям, сведенным судьбой для того, чтобы вместе сражаться против общего врага. Им приходится противостоять жадности и коррупции во времена, когда появление первых железных дорог изменило представление о власти и могуществе в мире.', 'lone_ranger'),
(2, 'Ранго', 'Rango', 'rango.jpg', 2011, 'Ранго - хамелеон, который живет в террариуме и считает себя героем, которому, к сожалению, никак не удается проявить свое бесстрашие. Но когда он внезапно оказывается в городке Грязь, у него появляется такая возможность. Ранго провозглашает себя борцом за справедливость и начинает вести себя как шериф на Диком Западе. Он еще не знает, что быть «хорошим парнем» в этих краях не самая завидная участь…', 'rango');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `original_url` varchar(250) NOT NULL COMMENT 'url to original review',
  `original_date` date NOT NULL COMMENT 'publish date',
  `content` text NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `author_id`, `movie_id`, `source_id`, `original_url`, `original_date`, `content`, `visible`, `date_add`) VALUES
(5, 4, 1, 24, 'http://kinoart.ru/ru/blogs/angry-bird', '2013-07-08', '<p><img src="/upload/reviews/2014/02/22/lone_ranger/loneranger1_13930617854737.jpg"></p><p>О приключенческом вестерне Гора Вербински «Одинокий рейнджер», снятом по мотивам одноименного американского телесериала 1949 года, – Нина Цыркун.</p><p>Всадник на белом коне – дипломированный юрист и герой техасских прерий, воплощение одних только достоинств, амальгама Зорро и Робина Гуда, которого когда-то звали Джон Рейд, да только имя забылось, и все знают его как Одинокого рейнджера. Человек в маске, изъясняющийся на безукоризненном английском (американском), никогда не бравший в рот сигарету и не прикасавшийся к бутылке и по первому зову «со скоростью света» скачущий на своем белоснежном Силвере помогать тем, кому нужна его помощь. Словом, рыцарь без страха и упрека, простодушно раскрывающий этимологию образа ковбоя, восходящего к рыцарским романам, но уже давно переформатированного в утрированную фигуру национального героя.</p><p>В радиосериале об Одиноком рейнджере, впервые вышедшем в эфир в январе 1933 года, его появление на экране анонсировала увертюра Джоаккино Россини из оперы о метком стрелке «Вильгельм Телль», которая используется и в фильме Гора Вербински «Одинокий рейнджер». Здесь заглавного героя играет высоченный (1м 96см) Арми Хаммер; рыцарь в белой шляпе и черной полумаске, ловко сидящий на коне, и следующий за ним по увековеченной Джоном Фордом Долине монументов индеец Тонто (Джонни Депп) в боевой раскраске напоминают Дон Кихота и Санчо Пансу.</p><p>«Одинокий рейнджер»</p><p><img src="/upload/reviews/2014/02/22/lone_ranger/loneranger2_13930617855752.jpg"></p><p>Надо сразу сказать, что трикстер Тонто явно переигрывает героического партнера – неудивительно, ведь играть чистое совершенство безумно сложно, приходится обходиться без выигрышных примочек. Зато у Джонни Деппа все козыри на руках. Чучело ворона на голове сразу же призывает вспомнить, что перед нами переодетый Джек Воробей, освоивший непритязательный постмодернистский код ироничного поведения. Сценаристы Джастин Хейс, Тед Эллиот и Терри Руссио снабдили Тонто его фирменными репликами и подбавили новых, типа «Птица сердится», как и полагается модернизированному персонажу.</p><p>Как и в первых тридцати выпусках киносериала об Одиноком рейнджере, вышедших в 1938 году (оригинальных копий не сохранилось; эпизоды из клочков реставрировали в 2009 году), и в сериях конца 1940-х это было в основном кино без женщин. В фильме Вербински появилась любовная линия, но лишь едва намеченная и не имеющая перспективы продолжения: у Руфи Уилсон в роли Ребекки мало шансов появиться в сиквеле, который, судя по тому, что здесь дана лишь экспозиция истории, обязательно должен быть. Зато Хелена Бонэм-Картер, пышноволосая бандерша с расписной костяной ногой, опять же судя по тому, что возникает здесь чем-то вроде «бога из машины», такими шансами располагает. Феминисткам не в чем упрекнуть ни авторов сценария, ни режиссера. Упреки – еще до выхода картины на экраны – посыпались с другой стороны: неужто, мол, так мало в стране настоящих индейцев (или, как их принято политкорректно называть, коренных американцев), что роль Тонто надо было отдать Джону Деппу? А вот сами команчи (к племени которых принадлежит Тонто) что называется не глядя (то есть, до премьеры) официально и по всем правилам приняли Деппа в свою семью, почтя за честь. (Кстати, индейские корни у Деппа все-таки имеются). Так или иначе, трудно не догадаться, что назначая на роль «Пятницы» Одинокого рейнджера такую звезду, как Депп, создатели фильма в свою очередь имели в виду отдать честь индейцам, историческим хозяевам земли американской.</p><p>«Одинокий рейнджер»</p><p><img src="/upload/reviews/2014/02/22/lone_ranger/loneranger3_13930617856601.jpg"></p><p>Надо сказать, что сюжет фильма подан явно с оглядкой не только на американцев (им он в той или иной степени известен; не считая радио- и киносериалов, это уже пятый полнометражный фильм о приключениях Джона Рейда), сколько на мирового зрителя, который получил в картине своего представителя – мальчугана, пришедшего на передвижную выставку истории Дикого Запада. Там, рядом с муляжами бизона и гризли в отдельной витрине выставлен манекен «благородного дикаря в естественной среде обитания», оживающего, чтобы поведать юному зрителю в маске Одинокого рейнджера правдивую историю из эпохи индейских войн. И эта рассказанная «духом» Тонто история приобретает черты мистики, социального реализма (связанного со строительством железных дорог, соединивших страну в единое целое) и, конечно, экшена. Не знаю, задумывали ли авторы соперничать с последним бондовским фильмом, открывавшимся длинной сценой схватки на крыше мчащегося на всех парах поезда, но реально они в это соревнование вступили и выиграли его с большим отрывом. Причем в этом эпизоде поучаствовал не только самолично Арми Хаммер, но и самолично Руфь Уилсон, которая слетела с крыши локомотива прямо на спину мчащейся лошади. Так что не спрашивай, за что голливудским звездам платят такие гонорары; им платят за дело.</p><p>«Одинокий рейнджер»</p><p><img src="/upload/reviews/2014/02/22/lone_ranger/loneranger5_1393061785762.jpg"></p>', 1, 1393061785),
(6, 5, 2, 14, 'http://weburg.net/news/27998', '2011-03-18', '<p><img src="/upload/reviews/2014/02/22/rango/468723_13930907131776.jpg"></p><p>Гор Вербински, отправивший в плавание пиратов Карибского моря, но так и не опустивший батискаф с именем Bioshock, в своем творческом перерыве решил сделать анимационный мультфильм, пользуясь всеми доступными ему дорогими технологиями.</p><p>Трейлер</p><p>Герои нового мультфильма — один уродливей другого, начиная от самого Ранго — зеленой кривой ящерицы и заканчивая гадким беззубым кротом — отцом воровского клана, чей нос напоминает вялую морковку. Но, несмотря на явную несимпатичность персонажей, они обладают другими качествами, так необходимыми зрителю: харизмой и индивидуальностью. А еще мультфильм непредсказуем: в «Ранго» никогда не знаешь, какой номер выкинут следующим.</p><p>Итак, в американской пустыне есть тихий городок. Да, точно такой, каким вы привыкли его видеть в вестернах. Городок-то дикозападный, но не жители. Он населен всевозможными ободранного и страшного вида жабами, хорьками, котами, опоссумами, индюками, черепахами, мышами, ящерицами — на фантазию сценаристы не поскупились. В этом городе даже детишки суровые, как челябинские мужчины.</p><p>Туда и попадает наш маленький зеленый друг. Он оказывается не лишен: а) актерского таланта и б) везения. С такими данными карьера на новом месте у Ранго идет в гору, но и события набирают обороты.</p><p><img src="/upload/reviews/2014/02/22/rango/01(68)_1393090713764.jpg"></p><p>Оказывается, что зверье в здешних местах ценит вовсе не презренный металл, именуемый золотом. В банках вместо желтых слитков с гербами хранится… вода. За воду дерутся, воду берегут, воды отчаянно не хватает. Куда она исчезает — вот задачка, с которой справится настоящий герой. И, как у настоящего героя, у Ранго, безусловно, есть группа поддержки: ящерица Бабито и группировка местных оборванцев всех мастей. Они помогут ему во всех безумных начинаниях и пойдут за ним, как коммунисты за вождем мирового пролетариата к светлому будущему, разве что флагом не маша.</p><p>Плохие парни тоже весьма колоритные — не только бандитские рожи, но и так называемые деловые люди, делающие на своей колокольне все только с выгодой для себя. Как и в жизни, здесь не все бандиты оказываются бандитами, а самые бандитские бандиты тоже заслуживают уважения. Кстати, главного злодея — гремучего змея — в русской версии озвучивает Иван Охлобыстин… и весьма успешно.</p><p>Спасибо всем мультипликационным богам (или просто сознательности Nickelodeon Movies) — на этот раз обошлось без 3D. Вот уж действительно, настоящим звездочкам понт не нужен. Эффекты зачастую выпячивают, если не хватает мозгов на нормальный сюжет и юмор. В «Ранго» и с первым, и со вторым все тип-топ, впрочем, как и с музыкальным сопровождением. Удачно переделанная классика и группа веселых комбрендо-сов с банджо и не только — заслуга великого композитора Ханса Циммера.</p><p><img src="/upload/reviews/2014/02/22/rango/02(86)_13930907143148.jpg"></p><p>И надпись «От создателей «Пиратов Карибского моря» красуется не просто так: не один только Гор Вербински участвовал в проекте. Во-первых, технология захвата движения помогла перенести в мультфильм образы Джонни Деппа и Билла Найи, они же и подарили своим персонажам (Ранго и Гремучке Джейку) голоса в оригинальной озвучке. А во-вторых, в мультфильме есть ряд моментов, прямо или косвенно связанных с пиратской трилогией.</p><p>Вопреки всем плюсам, я все же заметила несколько недогляделок. Например, когда Ранго напутствует один мудрый персонаж, он говорит: «Иди через пустыню за своей тенью». Когда Ранго уходит, видно, что тень падает почему-то вправо, а во вторых, вы понимаете, что будет, если весь день идти за своей тенью… На этом вроде бы все в минусах этого замечательного мультфильма для всей семьи.</p><p>Итоговый вердикт: Похождения неадекватной с виду ящерки понравятся взрослым и детям — никаких штучек-пердючек, а нормальный добрый юмор и умный сюжет.</p><p>Марианна Симонова</p>', 1, 1393090714),
(7, 6, 1, 14, 'http://weburg.net/news/46615', '2013-07-05', '<p><img src="/upload/reviews/2014/02/22/lone_ranger/611010_13930913645664.jpg"></p><p>Неутомим дух приключений. Хочется вот так вот выйти на улицу, да найти приключений, да чтоб запомнились, да чтобы со злодеями, роковыми красавицами, благородством и доброй концовкой. Ну а если с этим на улице напряг, то поискать подобное стоит в кинотеатрах. Ведь не зря же из дома вышли.</p><p>Расписание фильма в киноафише</p><p>Режиссер Гор Вербински за последние десять лет съел на приключенческих фильмах пять собак и одного жирного кабана. Но, покинув воды Карибского моря, а потом потеряв подводный утопический город Восторг, Вербински вернулся на сушу. И видно до того ему понравилось делать вестерны (а «Ранго» это вестерн, как ни крути), что захотелось  сделать полноценный фильм о Диком Западе с живыми актерами и без ящериц.</p><p>Конечно, отказываться от своего любимца Джонни Деппа режиссер и не думал. Он идеально вписывался в его замысел — экранизацию культового радиошоу 30-х годов с одноименным названием. Тем более, ему не впервой играть слегка повернутого странного типа, да и с индейцами встречаться приходилось. Получился Джек Воробей Дикого Запада, так же презираемый цивилизацией за свой образ жизни, так же обладающий своеобразными манерами и поведением, ну а неработающий компас заменили на неработающие часы. Вот вам и готов главный персонаж фильма.</p><p></p><p><img src="/upload/reviews/2014/02/22/lone_ranger/2161073(3)_13930913651872.jpg"></p><p>Почему же тогда фильм называется «Одинокий рейнджер», а не «Мстящий индеец»? Дань уважения, сила бренда, и желание хоть как-то показать, что в фильме есть и другие герои, которые пытаются догнать выдающегося лицедея. Догнать они могут только при одном условии — если зрителю надоел Джек Воробей и его ужимки. Если не надоел, то новый герой Деппа пойдет на ура, а остальные будут вяло плестись позади.</p><p>А главных героев тут великое множество. Вот обычный прокурор Джон Рид (Арми Хаммер), отрицательно относящийся к любому огнестрельному оружию, везет опаснейшего рецидивиста и каннибала Бутча Кавендиша (Уильям Фихтнер) на поезде, чтобы предать его суду. Вместе с ним на поезде едет индеец Тонто (Джонни Депп), мечтающий отомстить Кавендишу за истребление своей деревни. Фильма бы не было, если бы Кавендиш не сбежал, а прокурор и индеец не объединились, чтобы его поймать. Но путь их трагичен, и в определенный момент Рид должен будет надеть маску и стать безымянным одиноким рейнджером с револьвером в руке. Только так он сможет добиться справедливости.</p><p>А добро всегда должно быть с кулаками и, как в данном случае, в маске. Без противостояния алчного, двуличного и крайне мерзкого на вид зла и смешного, позитивного и притягательного добра невозможно никакое приключение. Здесь это есть, и его много. Фильм длиной почти три часа, хоть и получился, на мой взгляд, слишком затянутым, но свое удовольствие я от него получил. По сути те же «Пираты Карибского моря», просто антураж другой, и вместо фрегатов здесь воссозданные локомотивы XIX века.</p><p></p><p><img src="/upload/reviews/2014/02/22/lone_ranger/2161073(2)_13930913660177.jpg"></p><p>И это тот случай, когда огромный бюджет не навредил, а только помог сделать вестерн большим, интересным, безумно смешным приключенческим фильмом. Пусть сюжет будет местами шибко предсказуем, а главный злодей проявит себя раньше, чем это станет интригой, пусть три часа отсидеть в кинотеатре будет, как всегда, тяжеловато, и пусть сцена после титров ничего не будет собой представлять (это было немного обидно). Все это пусть — фильм оттого не станет хуже. Быть может, в нем найдется много лишнего, но перед нами еще один шедевр Гора Вербински, который просто хотел, чтобы его фильм был монументален, как предыдущие. Проделанная работа внушает, и тут надо благодарить режиссера за весь этот титанический труд. Желательно купив билет в кинотеатр.</p><p>Кирилл Илюхин</p>', 1, 1393091366);

-- --------------------------------------------------------

--
-- Table structure for table `review_queue`
--

CREATE TABLE IF NOT EXISTS `review_queue` (
  `review_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `status_text` varchar(250) NOT NULL,
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_start` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `name`, `url`) VALUES
(1, 'Кинокадр', 'http://www.kinokadr.ru'),
(2, 'Exler.ru', 'http://exler.ru'),
(3, 'Кино-Театр.ru', 'http://www.kino-teatr.ru'),
(4, 'Goblin EnterTorMent', 'http://kino.oper.ru'),
(5, 'Кинотом', 'http://kinotom.com'),
(6, 'TramVision', 'http://www.tramvision.ru'),
(7, 'Filmz.ru', 'http://www.filmz.ru'),
(8, 'Новости Кино', 'http://www.kinonews.ru/'),
(9, 'КиноКритик', 'http://critic.by'),
(10, 'Фильм.ру', 'http://www.film.ru'),
(11, 'КиноДом', 'http://kinodom.org'),
(12, 'Киноафиша Санкт-Петербурга', 'http://www.kinoafisha.info'),
(13, 'Kino-Govno', 'http://www.kino-govno.com'),
(14, 'Weburg', 'http://weburg.net'),
(15, '25-й кадр', 'http://25-k.com'),
(16, 'Котонавты', 'http://meownauts.com'),
(17, 'Uralweb.ru', 'http://www.uralweb.ru'),
(18, 'Ведомости', 'http://www.vedomosti.ru'),
(19, 'Кино.Муви.ру', 'http://kino.myvi.ru'),
(20, 'NewsLab', 'http://newslab.ru'),
(21, 'Ovideo.ru', 'http://www.ovideo.ru'),
(22, 'Газета.ru', 'http://www.gazeta.ru'),
(23, 'The Hollywood Reporter', 'http://www.thr.ru'),
(24, 'Искусство кино', 'http://kinoart.ru'),
(25, 'Российская газета', 'http://www.rg.ru'),
(26, 'Relax.by', 'http://mag.relax.by'),
(27, 'Киномания', 'http://www.kinomania.ru'),
(28, 'Lenta.ru', 'http://lenta.ru'),
(29, 'Time Out', 'http://www.timeout.ru'),
(30, 'сiбдепо', 'http://sibdepo.ru/'),
(31, 'VashDosug', 'http://www.vashdosug.ru'),
(32, 'Art1', 'http://art1.ru'),
(33, 'Нгс.Релакс', 'http://relax.ngs.ru'),
(34, 'GQ', 'http://www.gq.ru'),
(35, 'Огонёк', 'http://www.kommersant.ru'),
(36, 'РИА Новости', 'http://weekend.ria.ru'),
(37, 'Афиша Воздух', 'http://vozduh.afisha.ru'),
(38, 'Сеанс', 'http://seance.ru'),
(39, 'Ruskino.ru', 'http://ruskino.ru'),
(40, 'Фонтанка', 'http://www.fontanka.ru'),
(41, 'Итоги', 'http://www.itogi.ru'),
(42, 'КоммерсантЪ', 'http://www.kommersant.ru'),
(43, 'Правда.ру', 'http://www.pravda.ru'),
(44, 'Известия', 'http://izvestia.ru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
