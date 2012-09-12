-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-08-20 14:17:51
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for cms
DROP DATABASE IF EXISTS `cms`;
CREATE DATABASE IF NOT EXISTS `cms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cms`;


-- Dumping structure for table cms.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `content` longtext,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `onlytitle` int(1) DEFAULT '0',
  `articletype` int(1) DEFAULT '0',
  `author_id` int(11) DEFAULT NULL,
  `comments` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_articles_categories` (`category_id`),
  KEY `FK_articles_users` (`author_id`),
  CONSTRAINT `FK_articles_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_articles_users` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.articles: ~22 rows (approximately)
DELETE FROM `articles`;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `content`, `category_id`, `title`, `created_at`, `updated_at`, `url`, `status`, `onlytitle`, `articletype`, `author_id`, `comments`) VALUES
	(21, '<p>\r\n	The<strong><span style="background-color:#ffff00;"> weakest monsoon rainfall in three years</span></strong> is delaying sowing of rice, oilseeds and lentils in several parts of <a href="http://topics.bloomberg.com/india/">India</a>, Agriculture Secretary Ashish Bahuguna told reporters in <a href="http://topics.bloomberg.com/new-delhi/">New Delhi</a> today.</p>\r\n<p>\r\n	The deficient rains may prompt growers to shift to corn from peanuts in some parts, he said. The worst affected by the below-average rainfall are Karnataka, Gujarat, Maharashtra and Rajasthan states, he said.</p>\r\n<p>\r\n	The area under all the monsoon-sown crops fell 14 percent to 53.4 million hectares from a year earlier, the agriculture ministry said yesterday. Monsoon, which accounts for more than 70 percent of India&rsquo;s annual rainfall, is the worst since 2009 when showers were 22 percent less than a 50-year average.</p>\r\n<p>\r\n	To contact the reporter on this story: Pratik Parija in New Delhi at <a href="mailto:pparija@bloomberg.net" title="Send E-mail">pparija@bloomberg.net</a></p>\r\n', 3, 'Crop Sowing Delayed in Some Parts of India Due to Weak Rains', '2012-08-03 17:09:23', '2012-08-10 23:33:04', 'crop-sowing-delayed-in-some-parts-of-india-due-to-weak-rains', 1, 0, 0, 2, 1),
	(29, '<p>\r\n	SAN FRANCISCO &mdash; It is as if there is a revolving door to the executive suite at <span class="meta-org">Yahoo</span>. So many have filed in and out over the years: Terry Semel, Jerry Yang, Carol Bartz and Scott Thompson. On Tuesday, Marissa Mayer, a <span class="meta-org">Google</span> executive, will join the company as its fifth full-time chief executive in five years.</p>\r\n<p itemprop="articleBody">\r\n	Her challenge will not only be to resuscitate a struggling company, but to avoid the fate of so many other experienced executives who have run Yahoo.</p>\r\n<p itemprop="articleBody">\r\n	With 700 million monthly users, Yahoo commands one of the largest audiences on the Web. But the company, an Internet pioneer, has been unable to attract advertisers and increase revenue.</p>\r\n<p itemprop="articleBody">\r\n	The company continues to cede a greater share of the advertising market to competitors, notably Facebook and Google. The many chief executives have frustrated shareholders with a reliance on cutting costs to improve quarterly earnings reports rather than finding new areas for innovation and growth.</p>\r\n', 7, 'Marissa Mayer, new leader hopes to brighten user experience at Yahoo', '2012-08-06 13:15:28', '2012-08-10 21:34:50', 'marissa-mayer-new-leader-hopes-to-brighten-user-experience-at-yahoo', 1, 0, 0, 1, 1),
	(31, '<p>\r\n	India and Pakistan will resume bilateral ties with a &quot;short series&quot;, comprising three ODIs and two Twenty20 internationals, in December and January. The matches will be held between the Test and one-day legs of England&#39;s tour of India and will form the first bilateral series between the two sides since Pakistan toured India in end-2007. The decision was taken by the BCCI at its working committee meeting on Monday.</p>\r\n<p>\r\n	Rajiv Shukla, a senior BCCI official, said the plan was to hold the three ODIs in Chennai, Delhi and Kolkata, and the Twenty20 matches in Ahmedabad and Bangalore. &quot;The BCCI was firm that no India-Pakistan series will be held at a neutral venue so it was decided to invite them [Pakistan] after December 22 when the England team leaves after playing the Twenty20 Internationals,&quot; Shukla said.</p>\r\n<p class="news-body">\r\n	The decision comes after prolonged, high-level consultations between officials of the two boards and, latterly, of the two governments. BCCI president N Srinivasan and PCB chief Zaka Ashraf have held several discussions this year regarding resumption of ties, with Pakistan hoping to fit in a series at the end of the year, during the Christmas break in England&#39;s tour of India.</p>\r\n<p class="news-body">\r\n	&quot;It&#39;s a positive move by the BCCI,&quot; Ashraf told reporters at the Gaddafi Stadium in Lahore. &quot;It&#39;s been six months since I have been discussing with the BCCI about the possible revival of ties and the final breakthrough came during the IPL final. Ultimately, we have received the invite from the BCCI and now we will sit to discuss the modalities of the series.&quot;</p>\r\n', 5, 'India to host Pakistan for ODI series in December-January', '2012-08-06 18:08:06', '2012-08-10 09:53:23', 'india-to-host-pakistan-for-odi-series-in-decemberjanuary', 1, 0, 1, 1, 1),
	(32, '<h3 class="excerpt" style="color:blue;">\r\n	Newcastle manager Alan Pardew will leave the club&#39;s bid to lure Andy Carroll back to Tyneside to owner Mike Ashley.</h3>\r\n<p>\r\n	The 50-year-<sup>old </sup>is keen to secure the England international&#39;s return from Liverpool, with the Magpies having had an initial bid for a loan move with an option to buy rejected.</p>\r\n<p>\r\n	It seems likely that the success or otherwise of their approach will come down to finance as much as anything else, but Pardew, currently in Germany with his squad at their pre-season training camp, admits that has little to do with him.</p>\r\n<p>\r\n	He told the Evening Chronicle: &quot;That whole process is a little bit more involved with the chairman and the board at Liverpool.</p>\r\n<p>\r\n	&quot;We have got a great team here, a great squad, and if Andy Carroll comes, it will only add to us.</p>\r\n<p>\r\n	&quot;It&#39;s simple, really. Sometimes transfers are done at corporate level. I&#39;m slightly detached from that. It will be what it will be.</p>\r\n', 36, 'Pardew: Carroll deal in Ashley\'s hands', '2012-08-06 18:12:56', '2012-08-08 23:30:54', 'pardew-carroll-deal-in-ashleys-hands', 1, 0, 0, 1, 1),
	(33, '<p class="excerpt">\r\n	<strong>Sushil Kumar and Yogeshwar Dutt have enough experience to make the London 2012 Olympic Games a memorable event, feels national coach Yashvir Singh.</strong></p>\r\n<p>\r\n	The coach and mentor of the two wrestlers, who has closely witnessed their progress to the top, said the wrestlers have gained a lot of experience since their Olympics debut in 2004 Athens and are determined to make the quadrennial event count.<br />\r\n	<br />\r\n	&quot;They have the experience of two Olympics behind them.Sushil and Yogeshwar have also been part and parcel of numerous World Championships, both of them are well aware of what would be at stake in London,&quot; Yashvir said, a day before flying to Belarus for a training-cum-conditioning camp ahead of the Olympics.</p>\r\n<p>\r\n	source: <a href="http://www.espnstar.com/olympics/wrestling/news/detail/item829607/%27Sushil,Yogeshwar-best-bet-for-medal%27/" target="_blank">espnstar</a></p>\r\n', 41, '\'Sushil,Yogeshwar best bet for medal\'', '2012-08-10 21:32:17', '2012-08-10 21:36:57', 'sushilyogeshwar-best-bet-for-medal', 1, 0, 1, 1, 1),
	(34, '<p>\r\n	<span id="articleText"><span class="focusParagraph"><span class="articleLocatio&lt;/span&gt;n">(Reuters) - Morgan Stanley (<span id="symbol_MS.N_0">MS.N</span>) is in advanced talks over selling a stake in its multibillion-dollar commodities trading division to Qatar&#39;s sovereign wealth fund, CNBC reported on Friday, citing people familiar with the matter.</span></span></span></p>\r\n<p>\r\n	<span id="articleText">Talks have recently focused on the Qatar Investment Authority buying a minority stake, according to one of the people, CNBC reported on its website. It said a deal might be imminent, but cautioned the exact terms could not be determined and that discussions could still fall apart.</span></p>\r\n<p>\r\n	<span id="articleText">A Morgan Stanley spokeswoman declined to comment.</span></p>\r\n', 3, 'Morgan Stanley may sell commodity stake to Qatar - CNBC', '2012-08-10 21:35:42', '2012-08-10 21:35:42', 'morgan-stanley-may-sell-commodity-stake-to-qatar-cnbc', 1, 0, 0, 1, 1),
	(35, '<p>\r\n	After a week-long dry spell, the monsoon is expected to be active again at many places in central and eastern India.<br />\r\n	<br />\r\n	According to Indian Metrological Department, a low pressure area has formed over northwest Bay of Bengal and adjoining coastal areas of Odisha and West Bengal. It would move west-northwestwards across Odisha, Chhattisgarh and Madhya Pradesh. As a result, rain would occur at many places in Madhya Pradesh, Gujarat, Maharashtra, Odisha, Chhattisgarh and parts of Jharkhand and Bihar.<br />\r\n	<br />\r\n	Weatherman says monsoon would remain active for the rest of this month raising hopes of farmers of a good crop.<br />\r\n	<br />\r\n	So far, the country has received 22 per cent deficient rains this season. 63 per cent of the area had deficient or scanty rainfall.</p>\r\n', 44, 'East, central India expect rains after dry spell', '2012-08-10 21:36:29', '2012-08-13 01:19:35', 'east-central-india-expect-rains-after-dry-spell', 1, 0, 1, 2, 1),
	(36, '<p>\r\n	Impacted by weak refining margins and falling gas output, billionaire <a href="http://indiatoday.intoday.in/story/mukesh-ambani-calls-on-montek-singh-ahluwalia/1/203595.html" target="_blank">Mukesh Ambani-</a>led Reliance Industries Ltd (<a href="http://indiatoday.intoday.in/story/ril-may-sell-its-iconic-vimal-brand-and-textile-business/1/201871.html" target="_blank">RIL</a>) posted a 21- per cent fall in first quarter net profit, its third-straight quarter fall, but beat expectations of a 23-per cent decline.</p>\r\n<p>\r\n	The business conglomerate, with presence in sectors ranging from energy to retail, posted a lower net profit of <span class="rupee">R<span>s.</span></span>4,473 crore for the quarter ended June 30, 2012. RIL had posted a net profit of <span class="rupee">R<span>s.</span></span>5,661 crore in the same period of the last financial year.</p>\r\n<p>\r\n	&quot;RIL has improved its earnings profile as profits from operations were higher on a sequential basis on the back of volume growth in the refining business. We have commenced our next phase of capital investments in the refining and petrochemical segments to enhance earnings and value of our core energy businesses,&quot; its Mukesh D. Ambani, chairman and managing director, said.</p>\r\n<p>\r\n	RIL was likely to report a 23 - per cent decline in first-quarter net income. According to the median estimates of 25 analysts surveyed by Bloomberg, the company was expected to post a net profit of <span class="rupee">R<span>s.</span></span>4,380 crore in June quarter.</p>\r\n<p>\r\n	The firm, which was touted as the darling of investors till early this year, posted a turnover of <span class="rupee">R<span>s.</span></span>94,926 crore in the June quarter, an 8.1 - per cent rise from the sequential quarter.</p>\r\n<div style="position: fixed;">\r\n	<div id="new_selection_block0.27091975370095256" style="overflow: hidden; color: rgb(0, 0, 0); background-color: transparent; text-align: left; text-decoration: none; border: medium none;">\r\n		<br />\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 7, 'Reliance Industries Ltd posts lower net profit of Rs 4,473 crore in Q1', '2012-08-10 21:38:31', '2012-08-12 09:44:36', 'reliance-industries-ltd-posts-lower-net-profit-of-rs-4473-crore-in-q1', 1, 0, 0, 1, 1),
	(37, '<p>\r\n	Market maintained its bullish momentum for the second session in a row on renewed optimism over reviving reform process and buoyant global cues, driving the benchmark S&amp;P CNX Nifty higher by 26 points at the National Stock Exchange (NSE) today.</p>\r\n<p>\r\n	Trading began on a strong note on the back of buoyant global cues and firm buying in frontline blue-chips, capital goods and auto counters along with beaten down tech stocks.</p>\r\n<p>\r\n	The index maintained the strong momentum and touched intra-day high in mid afternoon. It witnessed bouts of profit- taking at higher levels, surrendering parts of early gains.However, it regained strength towards the final hours of trade on attractive low-level buying amid firm European bourses, which scaled to fresh 11-week high.</p>\r\n<p>\r\n	Trading sentiment was upbeat on expectations of swift implementation of long-pending policies to boost investment and invite foreign firms in key sectors, traders said.</p>\r\n<p>\r\n	Technology, oil &amp; energy and metal stocks attracted good buying interest, while auto, FMCG, pharma, telecom and select PSU banking scrips saw profit-taking. Maruti fell more than 8 per cent due to labour unrest in its Manesar plant.</p>\r\n<p>\r\n	On the global front, Asian markets closed higher, taking cues from overnight rally in US stocks on the back of strong corporate earnings as well as positive housing data.</p>\r\n<p>\r\n	The 50-share Nifty traded between a high of 5,257.75 and a low of 5,233.15 before closing at 5,242.70, a rise of 26.40 points, or 0.51 per cent, over the last close.</p>\r\n<p>\r\n	Cairn, BPCL, Infosys, IDFC, BHEL, Sterlite Industries, Tata Power, Bajaj Auto, Hindalco and Axis Bank were the top perrcentage wise gainers from the Nifty bunch. Maruti, Bank of Baroda, Kotak Bank, Bharti Airtel, SBIN, PNB, Asian Paints, Dr Reddy&#39;s, Hero Motocor and ACC ended with losses.</p>\r\n<p>\r\n	The turnover in cash segment surged to Rs 9,582.45 crore against Rs 8,856.50 crore yesterday. In all, 5,275.30 lakh shares changed hands in 49,86,567 trades. Market capitalisation stood at Rs 60,13,715 crore.</p>\r\n', 39, 'NSE Nifty up 26 points on reform buzz; Maruti takes a hit', '2012-08-10 21:39:19', '2012-08-12 09:36:32', 'nse-nifty-up-26-points-on-reform-buzz-maruti-takes-a-hit', 1, 0, 0, 1, 1),
	(38, '<p>\r\n	Trading activities on the Nigerian Stock Exchange (NSE) closed on a downward trend on Friday as some highly capitalised stocks recorded price losses.</p>\r\n<p>\r\n	The News Agency of Nigeria (NAN) reports&nbsp;that the All-Share Index which opened at 23,098.21 points depreciated by 2.9&nbsp;point or 0.01 per cent to close at&nbsp;23,095.31 Points.</p>\r\n<p>\r\n	Market capitalisation also declined by N24 billion or 0.3 per cent to close at N 7.347 trillion&nbsp;compared with N7.373 trillion recorded on Thursday.</p>\r\n<p>\r\n	New Gold&nbsp;led price losers&rsquo; chart shedding N12 to close at N2, 468 per unit.Nestle&nbsp;trailed with N5 to close at N500 per share, while GTB dropped by 65k to close at N16.85 per share.Nigerian Breweries also lost 50k to close at N116, while Berger Paint lost 42k to close at N8.12&nbsp;per share.</p>\r\n<p>\r\n	On the other hand, Guinness led the gainers&rsquo; chart&nbsp;chalking up N11.40 to close at N239.40 per share.Total followed&nbsp;with N2.50 to close at N133 per share, while Dangote Cement rose by N1.50 to close at N115 per share.Okomu Oil appreciated by N1.49 to close at N31.39, while Glaxosmithkline grew by N1.19 to close at N25.15 per share.In all, investors bought 277.88 million shares worth N2.1 billion traded in 4,034 deals compared with 411.97 million shares valued N3.2 billion traded in 4,696 deals Thursday.</p>\r\n', 39, 'Stocks shed some weight at NSE', '2012-08-10 21:39:40', '2012-08-10 21:39:40', 'stocks-shed-some-weight-at-nse', 1, 0, 1, 1, 1),
	(39, '<h3 class="title-sub-article">\r\n	It is likely that the third exchange will eat into the share of the two bourses</h3>\r\n<p>\r\n	There is a sense of urgency between the country&rsquo;s two established equity bourses National Stock Exchange (NSE) and Bombay Stock Exchange (BSE), following the imminent arrival of the third national exchange in MCX-SX.<br />\r\n	<br />\r\n	NSE, which is only two decades old, has risen like a giant among the world&rsquo;s leading exchanges, commanding almost 80 to 90 per cent of the market share in India. BSE is Asia&rsquo;s oldest exchange. Both are busy fine tuning strategies to counter the threat from the new player. For, it is likely that the third exchange will eat into the share of the two bourses.<br />\r\n	<br />\r\n	BSE that owns the iconic Sensex, its 30-stock index, and NSE, with its big share in the equity derivatives segment, have everything to lose. But, whether the new player will resort to ramp up volumes by encouraging institutional brokers and arbitrageurs, or whether they serve small investors need to be seen, say leading brokers and experts.<br />\r\n	<br />\r\n	Deena Mehta, a BSE board member and the person who earlier headed the exchange in very turbulent times, said BSE has to go for continuous product innovation to see how much they can satisfy customers. &ldquo;All exchanges need to serve the customer. That is most important. Whether it (MCX-SX) will serve customers, needs to be seen,&rdquo; she said.</p>\r\n', 39, 'NSE, BSE gird up for competition', '2012-08-10 21:40:07', '2012-08-10 21:40:07', 'nse-bse-gird-up-for-competition', 1, 0, 0, 1, 1),
	(40, '<p>\r\n	<b>Chandigarh:</b> The Reserve Bank of India (RBI) will shortly put into circulation rupee five denomination coins bearing the emblem of Indian Council Medical Research (ICMR).</p>\r\n<p>\r\n	These coins are being issued to mark the Centenary Year of the ICMR, a RBI spokesman said here today.</p>\r\n<p>\r\n	The new coins will be legal tender as provided in the Indian Coinage Act, 1906.</p>\r\n<p>\r\n	However, the existing coins in this denomination shall also continue to be legal tender.</p>\r\n', 40, 'RBI to issue Rs five coins bearing ICMR emblem', '2012-08-10 21:45:39', '2012-08-10 21:45:39', 'rbi-to-issue-rs-five-coins-bearing-icmr-emblem', 1, 0, 0, 1, 1),
	(41, '<p>\r\n	<b>Mumbai:</b> In volatile trade, the rupee today fell 20 paise to settle at 55.32 against the US dollar tracking weakness in local shares amid a firm dollar overseas as the Eurozone debt problems resurfaced.</p>\r\n<p>\r\n	Good dollar demand from importers, mainly oil refiners as Brent North Sea crude slid to USD 106.65 in London deals, also weighed on rupee while sustained capital inflows limited its fall to some extent, forex dealers said.</p>\r\n<p>\r\n	The rupee resumed lower at 55.25 a dollar from its previous close of 55.12 at the Interbank Foreign Exchange (Forex) market today and immediately touched a high of 55.08.</p>\r\n<p>\r\n	With the euro falling against the dollar on reports that Spain&#39;s Valencia region will seek help to repay loans, the sentiment in favour of rupee changed, traders said.</p>\r\n<p>\r\n	The rupee fell down to day&#39;s low of 55.33 at the fag end before closing at 55.32, showing a fall of 0.36 per cent.</p>\r\n', 40, 'Rupee drops 20 paise as US dollar gains overseas', '2012-08-10 21:46:06', '2012-08-12 09:35:54', 'rupee-drops-20-paise-as-us-dollar-gains-overseas', 1, 0, 0, 1, 1),
	(42, '<p>\r\n	MUMBAI, July 12 (Reuters) - Ailing national carrier Air India has invited banks to bid for underwriting roles in a sale of 74 billion rupees ($1.34 billion) of government-guaranteed bonds, a document seen by Reuters showed.</p>\r\n<p>\r\n	The sale would be the biggest corporate bond sale guaranteed by the government, and is part of India&#39;s commitment to resuscitate the country&#39;s flag carrier through a $5.8 billion government bailout. Despite the size, traders said Air India will not struggle to sell the 19-year bonds, given they would offer a higher yield than federal bonds of similar maturity while providing the same government &quot;unconditional and irrevocable guarantee.</p>\r\n<p>\r\n	&nbsp;&quot;(The) majority of the issue will go to the hands of big institutions like the provident funds and insurers as it has a central government guarantee,&quot; said Mohan Shenoi, president of group treasury and global markets at Kotak Mahindra Bank. Air India is seeking to sell the debt via a private placement of bonds, which will replace existing bank loans.</p>\r\n<p>\r\n	The bonds will be re-payable in five equal instalments starting in the 15th year from the date of allotment, the document showed. The airline is looking to pay a coupon that will offer a spread over a government security of similar maturity, but will be subject to an overall cap of 9.50 percent per year, according to the document.</p>\r\n', 2, 'Air India aims to sell 74 bln rupees of bonds', '2012-08-10 21:47:56', '2012-08-10 21:52:17', 'air-india-aims-to-sell-74-bln-rupees-of-bonds', 1, 1, 0, 1, 1),
	(43, '<p>\r\n	Guwahati, July 2 (ANI): The Prime Minister, Dr. Manmohan Singh, and UPA chairperson Sonia Gandhi undertook an aerial survey of flood-affected areas of Assam today.</p>\r\n<p>\r\n	Both leaders, who were also accompanied by Assam Chief Minister Tarun Gogoi, flew over Majuli Island, Jorhat, Sibsagar, Lakhimpur and Dhemaji districts of the state.</p>\r\n<p>\r\n	Dr. Singh and Gandhi will later hold talks with ministers and senior state government officials in Guwahati before flying back to New Delhi.</p>\r\n<p>\r\n	The current spell of floods and landslides has claimed 77 lives in Assam so far.</p>\r\n<p>\r\n	The recent flood, which is the worst in the state in the last eight years, has affected more than 19 lakh people with 23 of the state&#39;s 27 districts said to be under water.</p>\r\n<p>\r\n	The Prime Minister had earlier on June 28 announced an ex-gratia assistance to the families of those who had lost their lives in the recent floods in Assam.</p>\r\n<p>\r\n	An assistance of one lakh rupees was announced for the next of kin of each of the deceased from the Prime Minister&#39;s National Relief Fund.</p>\r\n<p>\r\n	The Prime Minister had then directed to extend all possible help to the state government in the relief operations.</p>\r\n<p>\r\n	Dr. Singh had also spoken to Assam Health Minister Hemanta Biswa Sarma and enquired about the flood situation in the state.</p>\r\n<p>\r\n	He also spoke with Defence Minister A. K. Antony, and urged him to provide full Army assistance for the rescue and relief operations in the affected flood areas. (ANI)</p>\r\n', 2, 'PM, Sonia assess Assam flood situation', '2012-08-10 21:48:17', '2012-08-15 10:26:03', 'pm-sonia-assess-assam-flood-situation', 1, 0, 0, 2, 1),
	(44, '<p>\r\n	Reuters) - American Crystal Cox, who won 4x400 metres relay gold at the 2004 Athens <a href="http://www.reuters.com/london-olympics-2012" title="Full coverage of the 2012 Summer Olympics">Olympics</a>, was stripped of her medal on Saturday, the International Olympic Committee said.</p>\r\n<p>\r\n	The IOC also confirmed Nigeria were awarded the gold medal at the 4x400m men&#39;s relay race from the Sydney 2000 Olympics after it closed the case on doping offender Antonio Pettigrew of the U.S.</p>\r\n<p>\r\n	Cox, the Athens relay alternate, was banned for four years in 2010 for using performance-enhancing drugs. The U.S. Anti-Doping Agency had said Cox had used prohibited anabolic agents between 2001 and 2004.</p>\r\n<p>\r\n	The IOC&#39;s Executive Board, however, did not make any decision on the other relay runners in the team, saying it was up to the International Association of Athletics Federations (IAAF) to decide if all the runners on the U.S. team would be stripped of their medals.</p>\r\n', 41, 'Olympics-Cox loses Athens gold, U.S lose Sydney medal', '2012-08-10 21:50:45', '2012-08-12 09:35:10', 'olympicscox-loses-athens-gold-us-lose-sydney-medal', 1, 0, 1, 1, 1),
	(45, '<p>\r\n	When <a class="meta-per" href="http://london2012.nytimes.com/athletes/jordyn-wieber?inline=nyt-per" title="More articles about Jordyn Wieber.">Jordyn Wieber</a>, the gymnastics world champion, lost an all-around title for only the second time since 2008, she did not frown or sulk.</p>\r\n<p itemprop="articleBody">\r\n	Instead, after falling to her new American rival, Gabby Douglas, by only a tenth of a point at the Olympic trials in early July, she wept tears of joy.</p>\r\n<p itemprop="articleBody">\r\n	&ldquo;I really can&rsquo;t believe I cried so much,&rdquo; Wieber said, looking incredulous that she allowed her hard exterior to crack. &ldquo;I guess it just all hit me at once. Everything I worked for my whole life is finally here. I&rsquo;m finally going to the Olympics.&rdquo;</p>\r\n<p itemprop="articleBody">\r\n	Wieber probably did not envision, though, that her Olympic dreams would include sharing the spotlight with someone else &mdash; someone on her very own team. But whether Wieber likes it or not, Douglas, an irrepressibly animated 16-year-old, in the past five months has blossomed into Wieber&rsquo;s main competition.</p>\r\n', 41, 'Same Team, Worlds Apart', '2012-08-10 21:51:16', '2012-08-13 00:58:00', 'same-team-worlds-apart', 1, 0, 0, 2, 1),
	(46, '<p>\r\n	Sabyasachi Panda, Orissa&#39;s top Maoist leader and main accused in VHP leader Swami Laxmanananda Saraswati&#39;s murder in 2008 and the kidnap of two Italian nationals earlier this year, has sought to scotch speculations about his surrender.</p>\r\n<p>\r\n	In an audiotape released to the media, Panda, secretary of Orissa State Organising Committee of CPI (Maoist), state police was deliberately spreading canard about him. &quot;Such speculation is nothing but silly police tactics,&quot; he said in the tape released late on Saturday.<br />\r\n	<br />\r\n	Speculation with regard to Panda&#39;s surrender was fuelled recently when his wife, Subhashree Das recently indicated that her husband could give up arms if Orissa government withdraws all cases against him.<br />\r\n	<br />\r\n	As it is Panda, who was in news when he abducted an Italian tourist and a tour operator from the same country in Kandhamal in March, is getting progressively alienated within the Maoist organization. He fell out with top Maoist leaders like Ramkrishna and Modem Balakrishna following the abduction of the foreigners since he had executed it without taking the top party leadership into confidence.</p>\r\n<div style="position: fixed;">\r\n	<div id="new_selection_block0.9726681258446398" style="overflow: hidden; color: rgb(0, 0, 0); background-color: transparent; text-align: left; text-decoration: none; border: medium none;">\r\n		<br />\r\n		&nbsp;</div>\r\n</div>\r\n<div style="position: fixed;">\r\n	<div id="new_selection_block0.36115568344911664" style="overflow: hidden; color: rgb(0, 0, 0); background-color: transparent; text-align: left; text-decoration: none; border: medium none;">\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 44, 'Top Maoist leader Sabyasachi Panda rules out surrender', '2012-08-13 01:21:18', '2012-08-13 01:21:18', 'top-maoist-leader-sabyasachi-panda-rules-out-surrender', 1, 0, 0, 1, 1),
	(47, '<p>\r\n	Former Maharashtra Chief Minister Ashok Chavan , an accused in the multi-crore Adarsh scam , returned <span class="rupee">R<span>s.</span></span>69 lakh, allegedly received by him from his &quot;close aide&quot; Jayant Shah to purchase flats for his relatives at the highrise, soon after the scandal was unearthed and a PIL was filed in the Bombay High Court in 2010</p>\r\n', 45, 'Adarsh scam accused Ashok Chavan returned Rs.69 lakh after the expose: CBI', '2012-08-13 01:22:28', '2012-08-15 10:46:23', 'adarsh-scam-accused-ashok-chavan-returned-rs69-lakh-after-the-expose-cbi', 1, 1, 0, 1, 1),
	(48, '<p>\r\n	The attack on Indian fishermen and the arrest of 23 of them besides the seizure of five vessels by the Sri Lankan Navy in the Palk Strait on Sunday has taken a serious turn. To protest this, fishermen fora in Rameswaram have called for a strike and heeding this call more than 10,000 boats have stayed away from the sea.</p>\r\n<p>\r\n	Meanwhile reports from the island nation said the arrested fishermen were produced before a magistrate at Mannar in the Jaffna peninsula and remanded in custody till August 6.</p>\r\n<p>\r\n	According to the fishermen they were attacked by the&nbsp;Navy without any provocation near the Katchativu area. The Lankan forces were alleged to have attacked 20 other boats and seized fishing nets. The barren and rocky islet, Katchativu, was ceded to Lanka in 1974 with a clause protecting the traditional rights of Indian fishermen which included drying nets and visiting the St Antony shrine without any restriction.</p>\r\n<p>\r\n	&quot;The indefinite strike would continue till our brethren are released unconditionally,&quot; said fishermen leaders N J Bose and A Arulanandam, who wanted the Centre to put an end to this.</p>\r\n<div style="position: fixed;">\r\n	<div id="new_selection_block0.06117254300604469" style="overflow: hidden; color: rgb(0, 0, 0); background-color: transparent; text-align: left; text-decoration: none; border: medium none;">\r\n		<br />\r\n		<br />\r\n		</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 43, 'Indian fishermen attacked by sri lankan navy', '2012-08-13 01:23:42', '2012-08-18 12:51:48', 'indian-fishermen-attacked-by-sri-lankan-navy', 1, 0, 1, 1, 1),
	(50, '<p>\r\n	A Simple content management system that allows a user to start his site/blog, features included are:</p>\r\n<p>\r\n	<span style="background-color:#ffff00;">To view Admin page, </span><a href="/admin"><span style="background-color:#ffff00;">click here</span></a><span style="background-color:#ffff00;"> (username: admin, password: admin)</span></p>\r\n<p>\r\n	1. Article Mgt<br />\r\n	2. Tag Mgt<br />\r\n	3. Comment Mgt<br />\r\n	4. Category &amp; Sub Category Mgt<br />\r\n	4. Visitor State management</p>\r\n<p>\r\n	All Url&#39;s of Article generated are &quot;Pretty Url&quot;, for better Search Engine Optimization. Various roles for include &quot;Adminstrator&quot;, &quot;Moderator&quot; &amp; &quot;Author&quot;</p>\r\n', 1, 'CMS Details', '2012-08-15 15:02:32', '2012-08-17 12:48:55', 'cms-details', 1, 0, 0, 1, 1),
	(51, '<p>\r\n	One person was killed and several others injured here in a clash that spread to neighbouring Aonla tehsil even as curfew was imposed in the city, officials said on Monday.<br />\r\n	<br />\r\n	The clash took place when a group of a particular community objected to the high music that was being played by a group of Kanwariyas who were passing from the Jogi Nadav locality. The group was going to Haridwar to offer prayers when the clash took place.</p>\r\n<p>\r\n	&quot;According to our reports, someone opened fire resulting in the death of a youth. This infuriated the mob and clashes began in most of the localities of the city,&quot; district magistrate Manish Chauhan said.</p>\r\n<p>\r\n	Over a dozen civilians and police personnel were also injured and curfew was imposed in the entire city by the wee hours of Monday.</p>\r\n<p>\r\n	&quot;We have arrested one person and are trying to catch others who were responsible for the clash,&quot; SP (City) SS Singh said.</p>\r\n<p>\r\n	Over a dozen vehicles, including those of police, roadways and over two dozen roadside shops were set on fire.</p>\r\n<div style="position: fixed;">\r\n	<div id="new_selection_block0.3808337328411089" style="overflow: hidden; color: rgb(0, 0, 0); background-color: transparent; text-align: left; text-decoration: none; border: medium none;">\r\n		<br />\r\n		<br />\r\n		Read more at: <a href="http://indiatoday.intoday.in/story/one-killed-in-clash-curfew-in-bareilly/1/209861.html" target="_blank_">http://indiatoday.intoday.in/story/one-killed-in-clash-curfew-in-bareilly/1/209861.html</a></div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 42, 'One killed in clash, curfew in Bareilly', '2012-08-13 01:24:40', '2012-08-15 10:59:36', 'one-killed-in-clash-curfew-in-bareilly', 1, 0, 0, 1, 1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- Dumping structure for table cms.articles_tags
DROP TABLE IF EXISTS `articles_tags`;
CREATE TABLE IF NOT EXISTS `articles_tags` (
  `article_id` int(10) DEFAULT NULL,
  `tag_id` int(10) DEFAULT NULL,
  KEY `FK_articles_tags_articles` (`article_id`),
  KEY `FK_articles_tags_tags` (`tag_id`),
  CONSTRAINT `FK_articles_tags_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_articles_tags_tags` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cms.articles_tags: ~43 rows (approximately)
DELETE FROM `articles_tags`;
/*!40000 ALTER TABLE `articles_tags` DISABLE KEYS */;
INSERT INTO `articles_tags` (`article_id`, `tag_id`) VALUES
	(NULL, 1),
	(NULL, 9),
	(NULL, 9),
	(NULL, 2),
	(NULL, 8),
	(NULL, 10),
	(NULL, 1),
	(NULL, 2),
	(NULL, 8),
	(NULL, 10),
	(NULL, 2),
	(NULL, 9),
	(NULL, 2),
	(NULL, 10),
	(NULL, 10),
	(NULL, 10),
	(NULL, 2),
	(NULL, 8),
	(NULL, 10),
	(NULL, 2),
	(NULL, 2),
	(32, 9),
	(32, 15),
	(NULL, 1),
	(NULL, 2),
	(NULL, 8),
	(NULL, 9),
	(31, 13),
	(31, 14),
	(29, 2),
	(44, 35),
	(44, 36),
	(41, 32),
	(37, 39),
	(45, 35),
	(45, 36),
	(35, 40),
	(43, 29),
	(43, 30),
	(51, 2),
	(51, 8),
	(48, 41),
	(48, 42);
/*!40000 ALTER TABLE `articles_tags` ENABLE KEYS */;


-- Dumping structure for table cms.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) DEFAULT NULL,
  `curl` varchar(50) DEFAULT NULL,
  `cdescription` varchar(300) DEFAULT NULL,
  `ctitle` varchar(100) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categories_categories` (`parent_id`),
  CONSTRAINT `FK_categories_categories` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.categories: ~14 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `cname`, `curl`, `cdescription`, `ctitle`, `parent_id`) VALUES
	(1, 'News', 'news', 'News updates all over the world', NULL, NULL),
	(2, 'Nation', 'nation', 'National updates ', NULL, NULL),
	(3, 'Commodities', 'commodities', 'Commodities trading education, including daily research and news, the basics of commodities, finding a commodity broker and trading', NULL, 1),
	(4, 'Sports', 'sports', 'Sports news, matches of football and cricket, live coverages, current happenings in the world of sports ', NULL, NULL),
	(5, 'Cricket', 'cricket', 'Cricket updates and much more...', NULL, 4),
	(7, 'Company & Industry', 'company-industry', 'National updates of compaines on various factors', NULL, 1),
	(36, 'Football', 'football', 'Latest updates on Football go here', NULL, 4),
	(39, 'Stock Market', 'stock-market', 'Stock market updates, stock buy & sell signals, current global economy impact on India', NULL, 1),
	(40, 'Banking & Finance', 'banking-finance', 'Updates on Interest rates', NULL, 1),
	(41, 'Olympic 2012', 'olympic-2012', 'London Olympics updates go here', NULL, NULL),
	(42, 'North', 'north', '', NULL, 2),
	(43, 'South', 'south', '', NULL, 2),
	(44, 'East', 'east', '', NULL, 2),
	(45, 'West', 'west', '', NULL, 2);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table cms.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(10) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `content` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `approved` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_comments_articles` (`article_id`),
  CONSTRAINT `FK_comments_articles` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.comments: ~10 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`ID`, `article_id`, `name`, `email`, `content`, `created_at`, `updated_at`, `approved`) VALUES
	(2, 32, 'name', 'sdfsdf@gdsf', 'You may also register an existing object instance as a singleton in the container.', '2012-07-18 10:07:09', '2012-07-19 23:29:52', 1),
	(7, 31, 'Laravel', 'Intro@laravel.com', 'An IoC container is simply a way of managing the creation of objects. You can use it to define the creation of complex objects, allowing you to resolve them throughout your application using a single line of code. You may also use it to "inject" dependencies into your classes and controllers.', '2012-07-18 14:01:44', '2012-07-19 23:29:47', 1),
	(15, 32, 'Ramesh', 'Ramesh@gmail.com', 'Test comment on a article', '2012-07-19 10:16:50', '2012-07-19 18:57:44', 1),
	(16, 32, 'Rohit', 'rohit@gmail.com', 'this is a test comment', '2012-07-19 10:17:05', '2012-07-19 23:29:40', 1),
	(23, 29, 'yahoo', 'yahoo@yahoo.com', 'Her challenge will not only be to resuscitate a moribund company but to avoid the fate of so many other experienced executives who have run Yahoo.\r\n', '2012-07-19 17:27:22', '2012-07-23 21:07:02', 1),
	(24, 29, 'Dewan Hou', 'mymailat@gmail.com', 'Just testing the commenting system', '2012-07-19 17:28:36', '2012-07-21 23:38:06', 1),
	(30, 45, 'Admin', 'admin@admin', 'Australian entrepreneur Dick Smith has blasted the head of News Limited, accusing the organisation of biased and intimidating reporting.', '2012-07-23 23:50:25', '2012-07-23 23:50:25', 1),
	(31, 45, 'Admin', 'admin@admin', 'he media company will form a brand called Amplify in partnership with AT&T, part of its strategy to further its efforts in the lucrative public ', '2012-07-23 23:50:38', '2012-08-20 12:49:27', 1),
	(32, 45, 'Admin', 'admin@admin', 'Colorado massacre suspect James Holmes gave no outward signs of mental illness or violent delusions, and mental experts said that is ...', '2012-07-23 23:50:53', '2012-08-20 13:44:54', 0),
	(39, 35, 'John', 'john@test.com', 'this is just a test comments', '2012-08-20 12:52:16', '2012-08-20 13:09:05', 1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for table cms.seo
DROP TABLE IF EXISTS `seo`;
CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cms.seo: ~0 rows (approximately)
DELETE FROM `seo`;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;


-- Dumping structure for table cms.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(40) NOT NULL,
  `last_activity` int(10) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table cms.sessions: 0 rows
DELETE FROM `sessions`;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- Dumping structure for table cms.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `keyname` varchar(50) DEFAULT NULL,
  `content` varchar(50) NOT NULL DEFAULT '0',
  `value` varchar(50) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `fieldtype` varchar(50) NOT NULL DEFAULT '0',
  `contentdetail` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.settings: ~9 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `keyname`, `content`, `value`, `type`, `fieldtype`, `contentdetail`) VALUES
	(1, 'articlesize', 'Article Size', '500', 'reading', 'text', '0'),
	(2, 'articlelimit', 'Article Limit', '8', 'reading', 'text', '0'),
	(3, 'textboxrows', 'Article TextBox size', '10', 'writing', 'text', '0'),
	(4, 'convertemotions', 'Covert symbols to emotions', '1', 'writing', 'select', '0'),
	(5, 'unregistercomments', 'All unregistered users to post comments', '1', 'comment', 'select', '0'),
	(6, 'commentsize', 'Comment Size', '500', 'comment', 'text', '0'),
	(7, 'maintenance', 'Maintenance', '0', 'General Settings', 'select', '0'),
	(8, 'commentblacklist', 'BlackList keywords', 'man,lan,can', 'comment', 'textarea', ' [a comment containig these words shall be unpproved, seperate words by comma ]'),
	(9, 'sitetitle', 'Site Title', 'PHP CMS', 'General Settings', 'text', '0');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table cms.tags
DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tname` varchar(100) DEFAULT '0',
  `turl` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.tags: ~35 rows (approximately)
DELETE FROM `tags`;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `tname`, `turl`) VALUES
	(1, 'sdfds sdf wes', 'sdfds-sdf-wes'),
	(2, 'new tag2', 'new-tag2'),
	(8, 'iisdf sdfmwe', 'iisdf-sdfmwe'),
	(9, 'ball', 'ball'),
	(10, 'bat', 'bat'),
	(13, 'criket updates', 'criket-updates'),
	(14, 'india vs pakistan', 'india-vs-pakistan'),
	(15, 'football fixtures', 'football-fixtures'),
	(16, 'football', 'football'),
	(17, 'ipl', 'ipl'),
	(18, 'barclays', 'barclays'),
	(19, 'foot ball leagues', 'foot-ball-leagues'),
	(20, 'hockey', 'hockey'),
	(21, 'tennis', 'tennis'),
	(22, 'indore games', 'indore-games'),
	(23, 'play station', 'play-station'),
	(24, 'sachin', 'sachin'),
	(25, 'stock updates', 'stock-updates'),
	(26, 'stock news', 'stock-news'),
	(27, 'market news', 'market-news'),
	(28, 'Assam floods', 'assam-floods'),
	(29, 'Prime Minister', 'prime-minister'),
	(30, 'Army', 'army'),
	(31, 'Morgan Stanley', 'morgan-stanley'),
	(32, 'Commodity', 'commodity'),
	(33, 'CNBC', 'cnbc'),
	(34, 'Qatar Investment', 'qatar-investment'),
	(35, 'Olympics', 'olympics'),
	(36, 'Sports 2012', 'sports-2012'),
	(37, 'Banking updates', 'banking-updates'),
	(38, 'Nifty', 'nifty'),
	(39, 'Nifty 50', 'nifty-50'),
	(40, 'Rainfall updates', 'rainfall-updates'),
	(41, 'Fishermen', 'fishermen'),
	(42, 'fish', 'fish');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;


-- Dumping structure for table cms.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(120) DEFAULT '0',
  `password` varchar(120) DEFAULT '0',
  `data` varchar(120) DEFAULT '0',
  `displayname` varchar(120) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `data`, `displayname`, `type`, `email`, `updated_at`, `created_at`) VALUES
	(1, 'Admin', '$2a$08$ZUhQc0hEVkNlS3N5Q0RjOORxbmQeRyqVImwdKaiajZdWpJWhka3NS', '23', 'Admin', 1, 'admin@admin', '2012-07-19 16:15:46', '2012-07-20 16:08:37'),
	(2, 'Dexter', '$2a$08$YmpRMEtuaEdxRjB2dDVJauLaI6gUun2UtwrfWGZtqNCzZLrqtX6ju', '0', 'Dexter', 2, 'dexter@gmail.com', '2012-07-19 16:08:16', '2012-07-19 16:09:39'),
	(3, 'Demo', '$2a$08$KZdxqK6JuHCyPsHT9hAS2.AiS2ZqEFUtn2bet8UlguMxqGXxsNnH.', '0', 'demo', 3, 'demo@gmail.com', '2012-07-19 20:24:34', '2012-07-19 16:08:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table cms.visitorslog
DROP TABLE IF EXISTS `visitorslog`;
CREATE TABLE IF NOT EXISTS `visitorslog` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `count` int(10) DEFAULT '0',
  `date` date DEFAULT NULL,
  `entityid` int(11) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `lastaccess` time DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `search` (`date`,`entityid`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

-- Dumping data for table cms.visitorslog: ~223 rows (approximately)
DELETE FROM `visitorslog`;
/*!40000 ALTER TABLE `visitorslog` DISABLE KEYS */;
INSERT INTO `visitorslog` (`ID`, `count`, `date`, `entityid`, `type`, `lastaccess`) VALUES
	(3, 5, '2012-07-20', 33, 'C', '18:00:56'),
	(5, 1, '2012-07-20', 37, 'C', '16:41:04'),
	(6, 13, '2012-07-20', 4, 'C', '20:55:24'),
	(7, 5, '2012-07-12', 2, 'C', '18:00:52'),
	(8, 2, '2012-07-17', 38, 'C', '17:18:30'),
	(9, 4, '2012-07-20', 1, 'C', '18:00:53'),
	(10, 1, '2012-07-18', 7, 'C', '16:44:23'),
	(11, 22, '2012-07-13', 3, 'C', '17:18:35'),
	(12, 8, '2012-07-18', 41, 'C', '18:00:31'),
	(13, 1, '2012-07-20', 36, 'C', '17:17:50'),
	(14, 1, '2012-07-19', 5, 'C', '17:18:00'),
	(15, 1, '2012-07-19', 19, 'A', '17:18:36'),
	(16, 1, '2012-07-19', 31, 'A', '17:19:36'),
	(17, 33, '2012-07-14', 32, 'A', '20:28:44'),
	(18, 34, '2012-07-15', 41, 'C', '20:14:34'),
	(19, 1, '2012-07-20', 31, 'A', '20:28:45'),
	(20, 20, '2012-07-17', 26, 'A', '20:28:48'),
	(21, 29, '2012-07-16', 10, 'A', '20:28:50'),
	(22, 4, '2012-07-15', 5, 'A', '20:28:50'),
	(23, 1, '2012-07-20', 32, 'A', '23:15:28'),
	(24, 5, '2012-07-21', 32, 'A', '15:25:18'),
	(25, 14, '2012-07-21', 2, 'C', '23:36:09'),
	(26, 50, '2012-07-21', 1, 'C', '23:38:44'),
	(27, 39, '2012-07-21', 7, 'C', '23:38:45'),
	(28, 0, '2012-07-21', 29, 'A', '14:00:42'),
	(29, 12, '2012-07-21', 36, 'C', '23:33:38'),
	(30, 0, '2012-07-21', 24, 'A', '08:59:26'),
	(31, 9, '2012-07-21', 41, 'C', '23:33:42'),
	(32, 44, '2012-07-21', 3, 'C', '23:37:28'),
	(33, 15, '2012-07-21', 40, 'C', '23:33:23'),
	(34, 8, '2012-07-21', 4, 'C', '23:33:35'),
	(35, 13, '2012-07-21', 38, 'C', '23:36:13'),
	(36, 1, '2012-07-21', 31, 'A', '23:33:40'),
	(37, 9, '2012-07-21', 5, 'C', '23:33:39'),
	(38, 3, '2012-07-21', 34, 'C', '21:48:31'),
	(39, 23, '2012-07-21', 39, 'C', '23:37:27'),
	(40, 4, '2012-07-21', 33, 'C', '21:48:53'),
	(41, 0, '2012-07-21', 9, 'A', '14:02:34'),
	(42, 0, '2012-07-21', 42, 'C', '14:04:52'),
	(43, 0, '2012-07-21', 43, 'C', '14:15:08'),
	(44, 2, '2012-07-21', 37, 'C', '21:48:30'),
	(45, 8, '2012-07-21', 45, 'A', '23:38:42'),
	(46, 1, '2012-07-21', 44, 'A', '22:26:07'),
	(47, 1, '2012-07-21', 36, 'A', '23:36:07'),
	(48, 1, '2012-07-21', 34, 'A', '23:37:29'),
	(49, 1, '2012-07-21', 41, 'A', '23:38:33'),
	(50, 15, '2012-07-22', 3, 'C', '09:35:07'),
	(51, 21, '2012-07-22', 7, 'C', '14:57:09'),
	(52, 13, '2012-07-22', 39, 'C', '14:57:11'),
	(53, 5, '2012-07-22', 40, 'C', '09:35:45'),
	(54, 1, '2012-07-22', 41, 'A', '00:11:03'),
	(55, 10, '2012-07-22', 2, 'C', '15:14:57'),
	(56, 7, '2012-07-22', 4, 'C', '14:57:05'),
	(57, 4, '2012-07-22', 41, 'C', '14:54:47'),
	(58, 9, '2012-07-22', 38, 'C', '15:00:17'),
	(59, 15, '2012-07-22', 1, 'C', '01:31:25'),
	(60, 1, '2012-07-22', 34, 'A', '00:12:48'),
	(61, 9, '2012-07-22', 45, 'A', '15:12:30'),
	(62, 2, '2012-07-22', 39, 'A', '14:55:19'),
	(63, 1, '2012-07-22', 36, 'A', '00:24:22'),
	(64, 1, '2012-07-22', 38, 'A', '01:23:14'),
	(65, 1, '2012-07-22', 44, 'A', '01:29:49'),
	(66, 1, '2012-07-22', 5, 'C', '01:30:20'),
	(67, 2, '2012-07-22', 36, 'C', '15:14:31'),
	(68, 1, '2012-07-22', 32, 'A', '14:56:36'),
	(69, 1, '2012-07-22', 43, 'A', '15:15:04'),
	(70, 14, '2012-07-23', 3, 'C', '22:08:26'),
	(71, 31, '2012-07-23', 45, 'A', '23:51:00'),
	(72, 4, '2012-07-23', 36, 'C', '22:08:28'),
	(73, 6, '2012-07-23', 32, 'A', '11:02:03'),
	(74, 19, '2012-07-23', 2, 'C', '22:07:30'),
	(75, 26, '2012-07-23', 43, 'A', '21:08:23'),
	(76, 4, '2012-07-23', 4, 'C', '22:07:30'),
	(77, 6, '2012-07-23', 41, 'C', '22:07:29'),
	(78, 8, '2012-07-23', 1, 'C', '22:07:31'),
	(79, 19, '2012-07-23', 7, 'C', '22:09:31'),
	(80, 8, '2012-07-23', 36, 'A', '22:08:19'),
	(81, 19, '2012-07-23', 34, 'A', '11:01:40'),
	(82, 19, '2012-07-23', 44, 'A', '21:50:09'),
	(83, 6, '2012-07-23', 38, 'C', '22:08:36'),
	(84, 2, '2012-07-23', 35, 'A', '21:50:04'),
	(85, 61, '2012-07-23', 29, 'A', '15:32:42'),
	(86, 3, '2012-07-23', 40, 'C', '22:09:32'),
	(87, 3, '2012-07-23', 35, 'T', '22:09:46'),
	(88, 1, '2012-07-23', 36, 'T', '21:50:12'),
	(89, 4, '2012-07-23', 39, 'C', '22:09:32'),
	(90, 1, '2012-07-23', 39, 'A', '21:52:33'),
	(91, 1, '2012-07-23', 42, 'A', '22:07:14'),
	(92, 1, '2012-07-23', 41, 'A', '22:07:24'),
	(93, 1, '2012-07-23', 5, 'C', '22:08:29'),
	(94, 34, '2012-07-24', 45, 'A', '16:41:58'),
	(95, 1, '2012-07-24', 41, 'A', '00:06:16'),
	(96, 1, '2012-07-24', 42, 'A', '00:06:17'),
	(97, 1, '2012-07-24', 40, 'A', '00:06:17'),
	(98, 2, '2012-07-24', 39, 'A', '00:56:14'),
	(99, 2, '2012-07-24', 38, 'A', '00:06:19'),
	(100, 4, '2012-07-24', 36, 'A', '10:19:42'),
	(101, 2, '2012-07-24', 37, 'A', '00:56:18'),
	(102, 15, '2012-07-24', 1, 'C', '17:41:27'),
	(103, 3, '2012-07-24', 29, 'A', '00:55:25'),
	(104, 13, '2012-07-24', 2, 'C', '17:41:28'),
	(105, 5, '2012-07-24', 38, 'C', '01:19:04'),
	(106, 10, '2012-07-24', 41, 'C', '17:45:56'),
	(107, 18, '2012-07-24', 7, 'C', '16:42:48'),
	(108, 5, '2012-07-24', 39, 'C', '16:42:49'),
	(109, 4, '2012-07-24', 40, 'C', '10:14:40'),
	(110, 13, '2012-07-24', 3, 'C', '16:42:46'),
	(111, 17, '2012-07-24', 36, 'C', '17:41:32'),
	(112, 2, '2012-07-24', 2, 'T', '09:27:58'),
	(113, 1, '2012-07-24', 43, 'A', '00:54:46'),
	(114, 3, '2012-07-24', 44, 'A', '00:55:55'),
	(115, 2, '2012-07-24', 34, 'A', '00:59:41'),
	(116, 3, '2012-07-24', 35, 'A', '09:52:33'),
	(117, 12, '2012-07-24', 4, 'C', '17:46:05'),
	(118, 6, '2012-07-24', 5, 'C', '17:46:10'),
	(119, 8, '2012-07-24', 45, 'C', '15:17:26'),
	(120, 17, '2012-07-24', 44, 'C', '16:48:13'),
	(121, 9, '2012-07-24', 43, 'C', '10:33:34'),
	(122, 8, '2012-07-24', 42, 'C', '16:43:00'),
	(123, 13, '2012-07-24', 49, 'A', '16:48:28'),
	(124, 2, '2012-07-24', 48, 'A', '09:37:57'),
	(125, 4, '2012-07-24', 32, 'A', '15:18:30'),
	(126, 4, '2012-07-24', 46, 'A', '16:48:15'),
	(127, 1, '2012-07-24', 36, 'T', '08:58:16'),
	(128, 77, '2012-07-24', 0, 'H', '17:47:43'),
	(129, 2, '2012-07-24', 40, 'T', '09:53:37'),
	(130, 1, '2012-07-24', 15, 'T', '15:18:27'),
	(131, 1, '2012-07-24', 47, 'A', '16:42:19'),
	(132, 1, '2012-07-24', 31, 'A', '16:47:35'),
	(133, 1, '2012-07-24', 14, 'T', '16:47:52'),
	(134, 26, '2012-07-25', 0, 'H', '15:53:41'),
	(135, 2, '2012-07-25', 49, 'A', '08:45:40'),
	(136, 4, '2012-07-25', 44, 'C', '15:36:07'),
	(137, 2, '2012-07-25', 42, 'C', '08:46:15'),
	(138, 5, '2012-07-25', 1, 'C', '15:48:13'),
	(139, 4, '2012-07-25', 2, 'C', '15:36:32'),
	(140, 3, '2012-07-25', 4, 'C', '15:36:39'),
	(141, 8, '2012-07-25', 41, 'C', '15:38:20'),
	(142, 3, '2012-07-25', 3, 'C', '15:35:52'),
	(143, 4, '2012-07-25', 33, 'A', '15:38:12'),
	(144, 5, '2012-07-25', 45, 'A', '15:35:49'),
	(145, 1, '2012-07-25', 47, 'A', '09:47:02'),
	(146, 2, '2012-07-25', 44, 'A', '15:53:45'),
	(147, 5, '2012-07-25', 34, 'A', '15:36:50'),
	(148, 2, '2012-07-25', 43, 'C', '15:36:12'),
	(149, 1, '2012-07-25', 45, 'C', '10:41:03'),
	(150, 1, '2012-07-25', 35, 'A', '10:42:02'),
	(151, 2, '2012-07-25', 36, 'C', '15:36:43'),
	(152, 3, '2012-07-25', 7, 'C', '15:54:43'),
	(153, 1, '2012-07-25', 39, 'C', '15:36:08'),
	(154, 1, '2012-07-25', 40, 'C', '15:36:18'),
	(155, 1, '2012-07-25', 36, 'A', '15:52:00'),
	(156, 1, '2012-07-25', 29, 'A', '15:54:46'),
	(157, 50, '2012-07-26', 0, 'H', '15:12:31'),
	(158, 2, '2012-07-26', 33, 'A', '14:37:46'),
	(159, 10, '2012-07-26', 45, 'A', '14:37:34'),
	(160, 8, '2012-07-26', 49, 'A', '14:16:16'),
	(161, 7, '2012-07-26', 1, 'C', '15:12:36'),
	(162, 3, '2012-07-26', 7, 'C', '14:17:54'),
	(163, 7, '2012-07-26', 41, 'C', '14:37:33'),
	(164, 1, '2012-07-26', 21, 'A', '11:04:21'),
	(165, 4, '2012-07-26', 4, 'C', '14:17:32'),
	(166, 3, '2012-07-26', 5, 'C', '11:43:15'),
	(167, 3, '2012-07-26', 36, 'C', '14:17:35'),
	(168, 1, '2012-07-26', 44, 'C', '12:36:00'),
	(169, 1, '2012-07-26', 46, 'A', '12:36:02'),
	(170, 1, '2012-07-26', 43, 'A', '12:36:08'),
	(171, 1, '2012-07-26', 8, 'T', '12:43:12'),
	(172, 1, '2012-07-26', 43, 'C', '14:16:23'),
	(173, 1, '2012-07-26', 48, 'A', '14:16:26'),
	(174, 2, '2012-07-26', 40, 'C', '14:18:19'),
	(175, 3, '2012-07-26', 39, 'C', '14:18:25'),
	(176, 1, '2012-07-26', 39, 'A', '14:17:00'),
	(177, 2, '2012-07-26', 2, 'C', '14:18:38'),
	(178, 1, '2012-07-26', 3, 'C', '14:17:56'),
	(179, 1, '2012-07-26', 50, 'A', '15:11:44'),
	(180, 9, '2012-08-13', 0, 'H', '19:44:56'),
	(181, 3, '2012-08-13', 51, 'A', '19:44:57'),
	(182, 3, '2012-08-13', 1, 'C', '12:40:37'),
	(183, 1, '2012-08-13', 4, 'C', '09:35:57'),
	(184, 1, '2012-08-13', 36, 'C', '09:35:58'),
	(185, 1, '2012-08-13', 5, 'C', '09:35:59'),
	(186, 1, '2012-08-13', 3, 'C', '09:36:01'),
	(187, 2, '2012-08-13', 7, 'C', '12:40:38'),
	(188, 2, '2012-08-13', 39, 'C', '12:40:39'),
	(189, 1, '2012-08-13', 40, 'C', '09:36:03'),
	(190, 1, '2012-08-13', 41, 'A', '09:36:05'),
	(191, 2, '2012-08-13', 50, 'A', '12:08:00'),
	(192, 1, '2012-08-13', 45, 'A', '12:08:01'),
	(193, 1, '2012-08-13', 36, 'T', '12:08:03'),
	(194, 5, '2012-08-16', 0, 'H', '13:46:27'),
	(195, 1, '2012-08-16', 51, 'A', '12:36:41'),
	(196, 3, '2012-08-17', 0, 'H', '20:26:32'),
	(197, 1, '2012-08-17', 51, 'A', '20:05:01'),
	(198, 1, '2012-08-17', 1, 'C', '20:05:02'),
	(199, 2, '2012-08-17', 7, 'C', '20:26:24'),
	(200, 2, '2012-08-17', 39, 'C', '20:26:23'),
	(201, 1, '2012-08-17', 40, 'C', '20:05:04'),
	(202, 1, '2012-08-17', 36, 'A', '20:26:24'),
	(203, 1, '2012-08-17', 45, 'A', '20:26:27'),
	(204, 1, '2012-08-17', 36, 'T', '20:26:32'),
	(205, 1, '2012-08-17', 2, 'C', '20:26:34'),
	(206, 1, '2012-08-17', 4, 'C', '20:26:34'),
	(207, 45, '2012-08-20', 0, 'H', '14:08:13'),
	(208, 1, '2012-08-20', 36, 'A', '12:48:01'),
	(209, 2, '2012-08-20', 42, 'C', '12:49:40'),
	(210, 11, '2012-08-20', 44, 'C', '13:24:34'),
	(211, 6, '2012-08-20', 43, 'C', '13:24:34'),
	(212, 7, '2012-08-20', 45, 'C', '13:06:55'),
	(213, 3, '2012-08-20', 4, 'C', '13:02:57'),
	(214, 2, '2012-08-20', 41, 'C', '13:02:58'),
	(215, 11, '2012-08-20', 2, 'C', '13:24:33'),
	(216, 12, '2012-08-20', 1, 'C', '13:24:35'),
	(217, 5, '2012-08-20', 50, 'A', '13:23:50'),
	(218, 4, '2012-08-20', 45, 'A', '13:04:41'),
	(219, 8, '2012-08-20', 51, 'A', '13:08:49'),
	(220, 2, '2012-08-20', 3, 'C', '12:59:03'),
	(221, 2, '2012-08-20', 7, 'C', '12:59:01'),
	(222, 2, '2012-08-20', 48, 'A', '12:51:51'),
	(223, 3, '2012-08-20', 35, 'A', '12:52:28'),
	(224, 1, '2012-08-20', 39, 'C', '12:59:02'),
	(225, 1, '2012-08-20', 40, 'C', '12:59:02'),
	(226, 1, '2012-08-20', 8, 'T', '13:04:34');
/*!40000 ALTER TABLE `visitorslog` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
