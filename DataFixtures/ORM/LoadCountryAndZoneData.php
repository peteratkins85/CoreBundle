<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 25/12/15
 * Time: 19:42
 */

namespace Oni\ProductManagerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oni\CoreBundle\Entity\Country;
use Oni\CoreBundle\Entity\Zone;
use Oni\ProductManagerBundle\Entity\Currency;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Oni\CoreBundle\Entity\Languages;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Validator\Constraints\Count;

class LoadCountryAndZoneData extends AbstractFixture implements OrderedFixtureInterface ,FixtureInterface, ContainerAwareInterface
{


    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        $countries = [];
        $em = $this->container->get('doctrine.orm.default_entity_manager');

        foreach ($this->getCountryData() as $country){
            $countries[$country['iso3']] = new Country();
            $countries[$country['iso3']]->setName($country['name']);
            $countries[$country['iso3']]->setIso($country['iso']);
            $countries[$country['iso3']]->setIso3($country['iso3']);
            $countries[$country['iso3']]->setLocale($country['locale']);
            $countries[$country['iso3']]->setNiceName($country['niceName']);
            $countries[$country['iso3']]->setNumCode($country['numCode']);
            $countries[$country['iso3']]->setPhoneCode($country['phoneCode']);

            $em->persist($countries[$country['iso3']]);
            $em->flush();

        }

        $this->addReference('GBR', $countries['GBR']);
        $zone = new Zone();
        $zone->setZoneName('Global');
        $zone->setZoneType('all');

        $zone1 = new Zone();
        $zone1->setZoneName('United Kingdom');
        $zone1->addCountry($countries['GBR']);

        $em->persist($zone);
        $em->persist($zone1);
        $em->flush();

        $this->addReference('globalZone', $zone);
        $this->addReference('ukZone', $zone);
    }

    public function getOrder()
    {
        return 0;
    }


    private function getCountryData()
    {
        return [
            ['id' => 1, 'iso' => 'AF', 'name' => 'AFGHANISTAN', 'niceName' => 'Afghanistan','iso3' => 'AFG','numCode' => 4,'phoneCode' => 93,'locale' => 'uz'],
            ['id' => 2, 'iso' => 'AL', 'name' => 'ALBANIA', 'niceName' => 'Albania','iso3' => 'ALB','numCode' => 8,'phoneCode' => 355,'locale' => 'sq'],
            ['id' => 3, 'iso' => 'DZ', 'name' => 'ALGERIA', 'niceName' => 'Algeria','iso3' => 'DZA','numCode' => 12,'phoneCode' => 213,'locale' => 'ka'],
            ['id' => 9, 'iso' => 'AG', 'name' => 'ANTIGUA AND BARBUDA', 'niceName' => 'Antigua and Barbuda','iso3' => 'ATG','numCode' => 28,'phoneCode' => 1268,'locale' => 'la'],
            ['id' => 10, 'iso' => 'AR', 'name' => 'ARGENTINA', 'niceName' => 'Argentina','iso3' => 'ARG','numCode' => 32,'phoneCode' => 54,'locale' => 'es'],
            ['id' => 11, 'iso' => 'AM', 'name' => 'ARMENIA', 'niceName' => 'Armenia','iso3' => 'ARM','numCode' => 51,'phoneCode' => 374,'locale' => 'ka'],
            ['id' => 13, 'iso' => 'AU', 'name' => 'AUSTRALIA', 'niceName' => 'Australia','iso3' => 'AUS','numCode' => 36,'phoneCode' => 61,'locale' => 'en'],
            ['id' => 14, 'iso' => 'AT', 'name' => 'AUSTRIA', 'niceName' => 'Austria','iso3' => 'AUT','numCode' => 40,'phoneCode' => 43,'locale' => 'de'],
            ['id' => 15, 'iso' => 'AZ', 'name' => 'AZERBAIJAN', 'niceName' => 'Azerbaijan','iso3' => 'AZE','numCode' => 31,'phoneCode' => 994,'locale' => 'az'],
            ['id' => 16, 'iso' => 'BS', 'name' => 'BAHAMAS', 'niceName' => 'Bahamas','iso3' => 'BHS','numCode' => 44,'phoneCode' => 1242,'locale' => 'bs'],
            ['id' => 17, 'iso' => 'BH', 'name' => 'BAHRAIN', 'niceName' => 'Bahrain','iso3' => 'BHR','numCode' => 48,'phoneCode' => 973,'locale' => 'ar'],
            ['id' => 18, 'iso' => 'BD', 'name' => 'BANGLADESH', 'niceName' => 'Bangladesh','iso3' => 'BGD','numCode' => 50,'phoneCode' => 880,'locale' => 'bn'],
            ['id' => 20, 'iso' => 'BY', 'name' => 'BELARUS', 'niceName' => 'Belarus','iso3' => 'BLR','numCode' => 112,'phoneCode' => 375,'locale' => 'be'],
            ['id' => 21, 'iso' => 'BE', 'name' => 'BELGIUM', 'niceName' => 'Belgium','iso3' => 'BEL','numCode' => 56,'phoneCode' => 32,'locale' => 'fr'],
            ['id' => 22, 'iso' => 'BZ', 'name' => 'BELIZE', 'niceName' => 'Belize','iso3' => 'BLZ','numCode' => 84,'phoneCode' => 501,'locale' => 'en'],
            ['id' => 23, 'iso' => 'BJ', 'name' => 'BENIN', 'niceName' => 'Benin','iso3' => 'BEN','numCode' => 204,'phoneCode' => 229,'locale' => 'fr'],
            ['id' => 24, 'iso' => 'BM', 'name' => 'BERMUDA', 'niceName' => 'Bermuda','iso3' => 'BMU','numCode' => 60,'phoneCode' => 1441,'locale' => 'bm'],
            ['id' => 26, 'iso' => 'BO', 'name' => 'BOLIVIA', 'niceName' => 'Bolivia','iso3' => 'BOL','numCode' => 68,'phoneCode' => 591,'locale' => 'es'],
            ['id' => 27, 'iso' => 'BA', 'name' => 'BOSNIA AND HERZEGOVINA', 'niceName' => 'Bosnia and Herzegovina','iso3' => 'BIH','numCode' => 70,'phoneCode' => 387,'locale' => 'sr'],
            ['id' => 28, 'iso' => 'BW', 'name' => 'BOTSWANA', 'niceName' => 'Botswana','iso3' => 'BWA','numCode' => 72,'phoneCode' => 267,'locale' => 'en'],
            ['id' => 30, 'iso' => 'BR', 'name' => 'BRAZIL', 'niceName' => 'Brazil','iso3' => 'BRA','numCode' => 76,'phoneCode' => 55,'locale' => 'pt'],
            ['id' => 32, 'iso' => 'BN', 'name' => 'BRUNEI DARUSSALAM', 'niceName' => 'Brunei Darussalam','iso3' => 'BRN','numCode' => 96,'phoneCode' => 673,'locale' => 'ms'],
            ['id' => 33, 'iso' => 'BG', 'name' => 'BULGARIA', 'niceName' => 'Bulgaria','iso3' => 'BGR','numCode' => 100,'phoneCode' => 359,'locale' => 'bg'],
            ['id' => 34, 'iso' => 'BF', 'name' => 'BURKINA FASO', 'niceName' => 'Burkina Faso','iso3' => 'BFA','numCode' => 854,'phoneCode' => 226,'locale' => 'fr'],
            ['id' => 35, 'iso' => 'BI', 'name' => 'BURUNDI', 'niceName' => 'Burundi','iso3' => 'BDI','numCode' => 108,'phoneCode' => 257,'locale' => 'fr'],
            ['id' => 36, 'iso' => 'KH', 'name' => 'CAMBODIA', 'niceName' => 'Cambodia','iso3' => 'KHM','numCode' => 116,'phoneCode' => 855,'locale' => 'km'],
            ['id' => 37, 'iso' => 'CM', 'name' => 'CAMEROON', 'niceName' => 'Cameroon','iso3' => 'CMR','numCode' => 120,'phoneCode' => 237,'locale' => 'fr'],
            ['id' => 38, 'iso' => 'CA', 'name' => 'CANADA', 'niceName' => 'Canada','iso3' => 'CAN','numCode' => 124,'phoneCode' => 1,'locale' => 'ca'],
            ['id' => 39, 'iso' => 'CV', 'name' => 'CAPE VERDE', 'niceName' => 'Cape Verde','iso3' => 'CPV','numCode' => 132,'phoneCode' => 238,'locale' => 'ke'],
            ['id' => 41, 'iso' => 'CF', 'name' => 'CENTRAL AFRICAN REPUBLIC', 'niceName' => 'Central African Republic','iso3' => 'CAF','numCode' => 140,'phoneCode' => 236,'locale' => 'fr'],
            ['id' => 42, 'iso' => 'TD', 'name' => 'CHAD', 'niceName' => 'Chad','iso3' => 'TCD','numCode' => 148,'phoneCode' => 235,'locale' => 'fr'],
            ['id' => 43, 'iso' => 'CL', 'name' => 'CHILE', 'niceName' => 'Chile','iso3' => 'CHL','numCode' => 152,'phoneCode' => 56,'locale' => 'es'],
            ['id' => 44, 'iso' => 'CN', 'name' => 'CHINA', 'niceName' => 'China','iso3' => 'CHN','numCode' => 156,'phoneCode' => 86,'locale' => 'zh'],
            ['id' => 47, 'iso' => 'CO', 'name' => 'COLOMBIA', 'niceName' => 'Colombia','iso3' => 'COL','numCode' => 170,'phoneCode' => 57,'locale' => 'es'],
            ['id' => 48, 'iso' => 'KM', 'name' => 'COMOROS', 'niceName' => 'Comoros','iso3' => 'COM','numCode' => 174,'phoneCode' => 269,'locale' => 'fr'],
            ['id' => 49, 'iso' => 'CG', 'name' => 'CONGO', 'niceName' => 'Congo','iso3' => 'COG','numCode' => 178,'phoneCode' => 242,'locale' => 'fr'],
            ['id' => 52, 'iso' => 'CR', 'name' => 'COSTA RICA', 'niceName' => 'Costa Rica','iso3' => 'CRI','numCode' => 188,'phoneCode' => 506,'locale' => 'es'],
            ['id' => 53, 'iso' => 'CI', 'name' => 'COTE D\'IVOIRE', 'niceName' => 'Cote D\'Ivoire','iso3' => 'CIV','numCode' => 384,'phoneCode' => 225,'locale' => 'fr'],
            ['id' => 54, 'iso' => 'HR', 'name' => 'CROATIA', 'niceName' => 'Croatia','iso3' => 'HRV','numCode' => 191,'phoneCode' => 385,'locale' => 'hr'],
            ['id' => 56, 'iso' => 'CY', 'name' => 'CYPRUS', 'niceName' => 'Cyprus','iso3' => 'CYP','numCode' => 196,'phoneCode' => 357,'locale' => 'el'],
            ['id' => 57, 'iso' => 'CZ', 'name' => 'CZECH REPUBLIC', 'niceName' => 'Czech Republic','iso3' => 'CZE','numCode' => 203,'phoneCode' => 420,'locale' => 'cs'],
            ['id' => 58, 'iso' => 'DK', 'name' => 'DENMARK', 'niceName' => 'Denmark','iso3' => 'DNK','numCode' => 208,'phoneCode' => 45,'locale' => 'da'],
            ['id' => 59, 'iso' => 'DJ', 'name' => 'DJIBOUTI', 'niceName' => 'Djibouti','iso3' => 'DJI','numCode' => 262,'phoneCode' => 253,'locale' => 'fr'],
            ['id' => 61, 'iso' => 'DO', 'name' => 'DOMINICAN REPUBLIC', 'niceName' => 'Dominican Republic','iso3' => 'DOM','numCode' => 214,'phoneCode' => 1809,'locale' => 'es'],
            ['id' => 62, 'iso' => 'EC', 'name' => 'ECUADOR', 'niceName' => 'Ecuador','iso3' => 'ECU','numCode' => 218,'phoneCode' => 593,'locale' => 'es'],
            ['id' => 63, 'iso' => 'EG', 'name' => 'EGYPT', 'niceName' => 'Egypt','iso3' => 'EGY','numCode' => 818,'phoneCode' => 20,'locale' => 'ar'],
            ['id' => 64, 'iso' => 'SV', 'name' => 'EL SALVADOR', 'niceName' => 'El Salvador','iso3' => 'SLV','numCode' => 222,'phoneCode' => 503,'locale' => 'es'],
            ['id' => 65, 'iso' => 'GQ', 'name' => 'EQUATORIAL GUINEA', 'niceName' => 'Equatorial Guinea','iso3' => 'GNQ','numCode' => 226,'phoneCode' => 240,'locale' => 'fr'],
            ['id' => 66, 'iso' => 'ER', 'name' => 'ERITREA', 'niceName' => 'Eritrea','iso3' => 'ERI','numCode' => 232,'phoneCode' => 291,'locale' => 'me'],
            ['id' => 67, 'iso' => 'EE', 'name' => 'ESTONIA', 'niceName' => 'Estonia','iso3' => 'EST','numCode' => 233,'phoneCode' => 372,'locale' => 'et'],
            ['id' => 68, 'iso' => 'ET', 'name' => 'ETHIOPIA', 'niceName' => 'Ethiopia','iso3' => 'ETH','numCode' => 231,'phoneCode' => 251,'locale' => 'am'],
            ['id' => 70, 'iso' => 'FO', 'name' => 'FAROE ISLANDS', 'niceName' => 'Faroe Islands','iso3' => 'FRO','numCode' => 234,'phoneCode' => 298,'locale' => 'fo'],
            ['id' => 72, 'iso' => 'FI', 'name' => 'FINLAND', 'niceName' => 'Finland','iso3' => 'FIN','numCode' => 246,'phoneCode' => 358,'locale' => 'sv'],
            ['id' => 73, 'iso' => 'FR', 'name' => 'FRANCE', 'niceName' => 'France','iso3' => 'FRA','numCode' => 250,'phoneCode' => 33,'locale' => 'fr'],
            ['id' => 77, 'iso' => 'GA', 'name' => 'GABON', 'niceName' => 'Gabon','iso3' => 'GAB','numCode' => 266,'phoneCode' => 241,'locale' => 'fr'],
            ['id' => 79, 'iso' => 'GE', 'name' => 'GEORGIA', 'niceName' => 'Georgia','iso3' => 'GEO','numCode' => 268,'phoneCode' => 995,'locale' => 'ka'],
            ['id' => 80, 'iso' => 'DE', 'name' => 'GERMANY', 'niceName' => 'Germany','iso3' => 'DEU','numCode' => 276,'phoneCode' => 49,'locale' => 'kd'],
            ['id' => 81, 'iso' => 'GH', 'name' => 'GHANA', 'niceName' => 'Ghana','iso3' => 'GHA','numCode' => 288,'phoneCode' => 233,'locale' => 'ha'],
            ['id' => 83, 'iso' => 'GR', 'name' => 'GREECE', 'niceName' => 'Greece','iso3' => 'GRC','numCode' => 300,'phoneCode' => 30,'locale' => 'el'],
            ['id' => 84, 'iso' => 'GL', 'name' => 'GREENLAND', 'niceName' => 'Greenland','iso3' => 'GRL','numCode' => 304,'phoneCode' => 299,'locale' => 'kl'],
            ['id' => 86, 'iso' => 'GP', 'name' => 'GUADELOUPE', 'niceName' => 'Guadeloupe','iso3' => 'GLP','numCode' => 312,'phoneCode' => 590,'locale' => 'fr'],
            ['id' => 87, 'iso' => 'GU', 'name' => 'GUAM', 'niceName' => 'Guam','iso3' => 'GUM','numCode' => 316,'phoneCode' => 1671,'locale' => 'en'],
            ['id' => 88, 'iso' => 'GT', 'name' => 'GUATEMALA', 'niceName' => 'Guatemala','iso3' => 'GTM','numCode' => 320,'phoneCode' => 502,'locale' => 'es'],
            ['id' => 89, 'iso' => 'GN', 'name' => 'GUINEA', 'niceName' => 'Guinea','iso3' => 'GIN','numCode' => 324,'phoneCode' => 224,'locale' => 'fr'],
            ['id' => 90, 'iso' => 'GW', 'name' => 'GUINEA-BISSAU', 'niceName' => 'Guinea-Bissau','iso3' => 'GNB','numCode' => 624,'phoneCode' => 245,'locale' => 'pt'],
            ['id' => 95, 'iso' => 'HN', 'name' => 'HONDURAS', 'niceName' => 'Honduras','iso3' => 'HND','numCode' => 340,'phoneCode' => 504,'locale' => 'es'],
            ['id' => 96, 'iso' => 'HK', 'name' => 'HONG KONG', 'niceName' => 'Hong Kong','iso3' => 'HKG','numCode' => 344,'phoneCode' => 852,'locale' => 'zh'],
            ['id' => 97, 'iso' => 'HU', 'name' => 'HUNGARY', 'niceName' => 'Hungary','iso3' => 'HUN','numCode' => 348,'phoneCode' => 36,'locale' => 'hu'],
            ['id' => 98, 'iso' => 'IS', 'name' => 'ICELAND', 'niceName' => 'Iceland','iso3' => 'ISL','numCode' => 352,'phoneCode' => 354,'locale' => 'is'],
            ['id' => 99, 'iso' => 'IN', 'name' => 'INDIA', 'niceName' => 'India','iso3' => 'IND','numCode' => 356,'phoneCode' => 91,'locale' => 'ml'],
            ['id' => 100, 'iso' => 'ID', 'name' => 'INDONESIA', 'niceName' => 'Indonesia','iso3' => 'IDN','numCode' => 360,'phoneCode' => 62,'locale' => 'id'],
            ['id' => 101, 'iso' => 'IR', 'name' => 'IRAN, ISLAMIC REPUBLIC OF', 'niceName' => 'Iran, Islamic Republic of','iso3' => 'IRN','numCode' => 364,'phoneCode' => 98,'locale' => 'fa'],
            ['id' => 102, 'iso' => 'IQ', 'name' => 'IRAQ', 'niceName' => 'Iraq','iso3' => 'IRQ','numCode' => 368,'phoneCode' => 964,'locale' => 'ar'],
            ['id' => 103, 'iso' => 'IE', 'name' => 'IRELAND', 'niceName' => 'Ireland','iso3' => 'IRL','numCode' => 372,'phoneCode' => 353,'locale' => 'en'],
            ['id' => 104, 'iso' => 'IL', 'name' => 'ISRAEL', 'niceName' => 'Israel','iso3' => 'ISR','numCode' => 376,'phoneCode' => 972,'locale' => 'fi'],
            ['id' => 105, 'iso' => 'IT', 'name' => 'ITALY', 'niceName' => 'Italy','iso3' => 'ITA','numCode' => 380,'phoneCode' => 39,'locale' => 'it'],
            ['id' => 106, 'iso' => 'JM', 'name' => 'JAMAICA', 'niceName' => 'Jamaica','iso3' => 'JAM','numCode' => 388,'phoneCode' => 1876,'locale' => 'en'],
            ['id' => 107, 'iso' => 'JP', 'name' => 'JAPAN', 'niceName' => 'Japan','iso3' => 'JPN','numCode' => 392,'phoneCode' => 81,'locale' => 'ja'],
            ['id' => 108, 'iso' => 'JO', 'name' => 'JORDAN', 'niceName' => 'Jordan','iso3' => 'JOR','numCode' => 400,'phoneCode' => 962,'locale' => 'ar'],
            ['id' => 109, 'iso' => 'KZ', 'name' => 'KAZAKHSTAN', 'niceName' => 'Kazakhstan','iso3' => 'KAZ','numCode' => 398,'phoneCode' => 7,'locale' => 'kk'],
            ['id' => 110, 'iso' => 'KE', 'name' => 'KENYA', 'niceName' => 'Kenya','iso3' => 'KEN','numCode' => 404,'phoneCode' => 254,'locale' => 'ka'],
            ['id' => 111, 'iso' => 'KI', 'name' => 'KIRIBATI', 'niceName' => 'Kiribati','iso3' => 'KIR','numCode' => 296,'phoneCode' => 686,'locale' => 'ki'],
            ['id' => 113, 'iso' => 'KR', 'name' => 'KOREA, REPUBLIC OF', 'niceName' => 'Korea, Republic of','iso3' => 'KOR','numCode' => 410,'phoneCode' => 82,'locale' => 'ko'],
            ['id' => 114, 'iso' => 'KW', 'name' => 'KUWAIT', 'niceName' => 'Kuwait','iso3' => 'KWT','numCode' => 414,'phoneCode' => 965,'locale' => 'ar'],
            ['id' => 117, 'iso' => 'LV', 'name' => 'LATVIA', 'niceName' => 'Latvia','iso3' => 'LVA','numCode' => 428,'phoneCode' => 371,'locale' => 'lv'],
            ['id' => 118, 'iso' => 'LB', 'name' => 'LEBANON', 'niceName' => 'Lebanon','iso3' => 'LBN','numCode' => 422,'phoneCode' => 961,'locale' => 'ar'],
            ['id' => 121, 'iso' => 'LY', 'name' => 'LIBYA', 'niceName' => 'LIBYA','iso3' => 'LBY','numCode' => 434,'phoneCode' => 218,'locale' => 'ar'],
            ['id' => 122, 'iso' => 'LI', 'name' => 'LIECHTENSTEIN', 'niceName' => 'Liechtenstein','iso3' => 'LIE','numCode' => 438,'phoneCode' => 423,'locale' => 'de'],
            ['id' => 123, 'iso' => 'LT', 'name' => 'LITHUANIA', 'niceName' => 'Lithuania','iso3' => 'LTU','numCode' => 440,'phoneCode' => 370,'locale' => 'lt'],
            ['id' => 124, 'iso' => 'LU', 'name' => 'LUXEMBOURG', 'niceName' => 'Luxembourg','iso3' => 'LUX','numCode' => 442,'phoneCode' => 352,'locale' => 'fr'],
            ['id' => 125, 'iso' => 'MO', 'name' => 'MACAO', 'niceName' => 'Macao','iso3' => 'MAC','numCode' => 446,'phoneCode' => 853,'locale' => 'zh'],
            ['id' => 126, 'iso' => 'MK', 'name' => 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'niceName' => 'Macedonia, the Former Yugoslav Republic of','iso3' => 'MKD','numCode' => 807,'phoneCode' => 389,'locale' => 'mk'],
            ['id' => 127, 'iso' => 'MG', 'name' => 'MADAGASCAR', 'niceName' => 'Madagascar','iso3' => 'MDG','numCode' => 450,'phoneCode' => 261,'locale' => 'fr'],
            ['id' => 129, 'iso' => 'MY', 'name' => 'MALAYSIA', 'niceName' => 'Malaysia','iso3' => 'MYS','numCode' => 458,'phoneCode' => 60,'locale' => 'my'],
            ['id' => 131, 'iso' => 'ML', 'name' => 'MALI', 'niceName' => 'Mali','iso3' => 'MLI','numCode' => 466,'phoneCode' => 223,'locale' => 'bm'],
            ['id' => 132, 'iso' => 'MT', 'name' => 'MALTA', 'niceName' => 'Malta','iso3' => 'MLT','numCode' => 470,'phoneCode' => 356,'locale' => 'mt'],
            ['id' => 133, 'iso' => 'MH', 'name' => 'MARSHALL ISLANDS', 'niceName' => 'Marshall Islands','iso3' => 'MHL','numCode' => 584,'phoneCode' => 692,'locale' => 'en'],
            ['id' => 134, 'iso' => 'MQ', 'name' => 'MARTINIQUE', 'niceName' => 'Martinique','iso3' => 'MTQ','numCode' => 474,'phoneCode' => 596,'locale' => 'fr'],
            ['id' => 135, 'iso' => 'MR', 'name' => 'MAURITANIA', 'niceName' => 'Mauritania','iso3' => 'MRT','numCode' => 478,'phoneCode' => 222,'locale' => 'mr'],
            ['id' => 136, 'iso' => 'MU', 'name' => 'MAURITIUS', 'niceName' => 'Mauritius','iso3' => 'MUS','numCode' => 480,'phoneCode' => 230,'locale' => 'en'],
            ['id' => 138, 'iso' => 'MX', 'name' => 'MEXICO', 'niceName' => 'Mexico','iso3' => 'MEX','numCode' => 484,'phoneCode' => 52,'locale' => 'es'],
            ['id' => 140, 'iso' => 'MD', 'name' => 'MOLDOVA, REPUBLIC OF', 'niceName' => 'Moldova, Republic of','iso3' => 'MDA','numCode' => 498,'phoneCode' => 373,'locale' => 'ro'],
            ['id' => 141, 'iso' => 'MC', 'name' => 'MONACO', 'niceName' => 'Monaco','iso3' => 'MCO','numCode' => 492,'phoneCode' => 377,'locale' => 'jm'],
            ['id' => 143, 'iso' => 'MS', 'name' => 'MONTSERRAT', 'niceName' => 'Montserrat','iso3' => 'MSR','numCode' => 500,'phoneCode' => 1664,'locale' => 'ms'],
            ['id' => 144, 'iso' => 'MA', 'name' => 'MOROCCO', 'niceName' => 'Morocco','iso3' => 'MAR','numCode' => 504,'phoneCode' => 212,'locale' => 'sh'],
            ['id' => 145, 'iso' => 'MZ', 'name' => 'MOZAMBIQUE', 'niceName' => 'Mozambique','iso3' => 'MOZ','numCode' => 508,'phoneCode' => 258,'locale' => 'pt'],
            ['id' => 146, 'iso' => 'MM', 'name' => 'MYANMAR', 'niceName' => 'Myanmar','iso3' => 'MMR','numCode' => 104,'phoneCode' => 95,'locale' => 'my'],
            ['id' => 147, 'iso' => 'NA', 'name' => 'NAMIBIA', 'niceName' => 'Namibia','iso3' => 'NAM','numCode' => 516,'phoneCode' => 264,'locale' => 'en'],
            ['id' => 149, 'iso' => 'NP', 'name' => 'NEPAL', 'niceName' => 'Nepal','iso3' => 'NPL','numCode' => 524,'phoneCode' => 977,'locale' => 'ne'],
            ['id' => 150, 'iso' => 'NL', 'name' => 'NETHERLANDS', 'niceName' => 'Netherlands','iso3' => 'NLD','numCode' => 528,'phoneCode' => 31,'locale' => 'nl'],
            ['id' => 153, 'iso' => 'NZ', 'name' => 'NEW ZEALAND', 'niceName' => 'New Zealand','iso3' => 'NZL','numCode' => 554,'phoneCode' => 64,'locale' => 'en'],
            ['id' => 154, 'iso' => 'NI', 'name' => 'NICARAGUA', 'niceName' => 'Nicaragua','iso3' => 'NIC','numCode' => 558,'phoneCode' => 505,'locale' => 'es'],
            ['id' => 155, 'iso' => 'NE', 'name' => 'NIGER', 'niceName' => 'Niger','iso3' => 'NER','numCode' => 562,'phoneCode' => 227,'locale' => 'ne'],
            ['id' => 156, 'iso' => 'NG', 'name' => 'NIGERIA', 'niceName' => 'Nigeria','iso3' => 'NGA','numCode' => 566,'phoneCode' => 234,'locale' => 'ig'],
            ['id' => 159, 'iso' => 'MP', 'name' => 'NORTHERN MARIANA ISLANDS', 'niceName' => 'Northern Mariana Islands','iso3' => 'MNP','numCode' => 580,'phoneCode' => 1670,'locale' => 'en'],
            ['id' => 160, 'iso' => 'NO', 'name' => 'NORWAY', 'niceName' => 'Norway','iso3' => 'NOR','numCode' => 578,'phoneCode' => 47,'locale' => 'nb'],
            ['id' => 161, 'iso' => 'OM', 'name' => 'OMAN', 'niceName' => 'Oman','iso3' => 'OMN','numCode' => 512,'phoneCode' => 968,'locale' => 'om'],
            ['id' => 162, 'iso' => 'PK', 'name' => 'PAKISTAN', 'niceName' => 'Pakistan','iso3' => 'PAK','numCode' => 586,'phoneCode' => 92,'locale' => 'pa'],
            ['id' => 164, 'iso' => 'PS', 'name' => 'PALESTINIAN TERRITORY, OCCUPIED', 'niceName' => 'Palestinian Territory, Occupied','iso3' => '','numCode' => 0,'phoneCode' => 970,'locale' => 'ps'],
            ['id' => 165, 'iso' => 'PA', 'name' => 'PANAMA', 'niceName' => 'Panama','iso3' => 'PAN','numCode' => 591,'phoneCode' => 507,'locale' => 'es'],
            ['id' => 167, 'iso' => 'PY', 'name' => 'PARAGUAY', 'niceName' => 'Paraguay','iso3' => 'PRY','numCode' => 600,'phoneCode' => 595,'locale' => 'es'],
            ['id' => 168, 'iso' => 'PE', 'name' => 'PERU', 'niceName' => 'Peru','iso3' => 'PER','numCode' => 604,'phoneCode' => 51,'locale' => 'es'],
            ['id' => 169, 'iso' => 'PH', 'name' => 'PHILIPPINES', 'niceName' => 'Philippines','iso3' => 'PHL','numCode' => 608,'phoneCode' => 63,'locale' => 'fi'],
            ['id' => 171, 'iso' => 'PL', 'name' => 'POLAND', 'niceName' => 'Poland','iso3' => 'POL','numCode' => 616,'phoneCode' => 48,'locale' => 'pl'],
            ['id' => 172, 'iso' => 'PT', 'name' => 'PORTUGAL', 'niceName' => 'Portugal','iso3' => 'PRT','numCode' => 620,'phoneCode' => 351,'locale' => 'pt'],
            ['id' => 173, 'iso' => 'PR', 'name' => 'PUERTO RICO', 'niceName' => 'Puerto Rico','iso3' => 'PRI','numCode' => 630,'phoneCode' => 1787,'locale' => 'es'],
            ['id' => 174, 'iso' => 'QA', 'name' => 'QATAR', 'niceName' => 'Qatar','iso3' => 'QAT','numCode' => 634,'phoneCode' => 974,'locale' => 'ar'],
            ['id' => 175, 'iso' => 'RE', 'name' => 'REUNION', 'niceName' => 'Reunion','iso3' => 'REU','numCode' => 638,'phoneCode' => 262,'locale' => 'fr'],
            ['id' => 176, 'iso' => 'RO', 'name' => 'ROMANIA', 'niceName' => 'Romania','iso3' => 'ROM','numCode' => 642,'phoneCode' => 40,'locale' => 'ro'],
            ['id' => 177, 'iso' => 'RU', 'name' => 'RUSSIAN FEDERATION', 'niceName' => 'Russian Federation','iso3' => 'RUS','numCode' => 643,'phoneCode' => 70,'locale' => 'pa'],
            ['id' => 178, 'iso' => 'RW', 'name' => 'RWANDA', 'niceName' => 'Rwanda','iso3' => 'RWA','numCode' => 646,'phoneCode' => 250,'locale' => 'fr'],
            ['id' => 180, 'iso' => 'KN', 'name' => 'SAINT KITTS AND NEVIS', 'niceName' => 'Saint Kitts and Nevis','iso3' => 'KNA','numCode' => 659,'phoneCode' => 1869,'locale' => 'kn'],
            ['id' => 187, 'iso' => 'SA', 'name' => 'SAUDI ARABIA', 'niceName' => 'Saudi Arabia','iso3' => 'SAU','numCode' => 682,'phoneCode' => 966,'locale' => 'ar'],
            ['id' => 188, 'iso' => 'SN', 'name' => 'SENEGAL', 'niceName' => 'Senegal','iso3' => 'SEN','numCode' => 686,'phoneCode' => 221,'locale' => 'sn'],
            ['id' => 189, 'iso' => 'CS', 'name' => 'SERBIA AND MONTENEGRO', 'niceName' => 'Serbia and Montenegro','iso3' => '','numCode' => 0,'phoneCode' => 381,'locale' => 'cs'],
            ['id' => 191, 'iso' => 'SL', 'name' => 'SIERRA LEONE', 'niceName' => 'Sierra Leone','iso3' => 'SLE','numCode' => 694,'phoneCode' => 232,'locale' => 'sl'],
            ['id' => 192, 'iso' => 'SG', 'name' => 'SINGAPORE', 'niceName' => 'Singapore','iso3' => 'SGP','numCode' => 702,'phoneCode' => 65,'locale' => 'sg'],
            ['id' => 193, 'iso' => 'SK', 'name' => 'SLOVAKIA', 'niceName' => 'Slovakia','iso3' => 'SVK','numCode' => 703,'phoneCode' => 421,'locale' => 'sk'],
            ['id' => 194, 'iso' => 'SI', 'name' => 'SLOVENIA', 'niceName' => 'Slovenia','iso3' => 'SVN','numCode' => 705,'phoneCode' => 386,'locale' => 'si'],
            ['id' => 196, 'iso' => 'SO', 'name' => 'SOMALIA', 'niceName' => 'Somalia','iso3' => 'SOM','numCode' => 706,'phoneCode' => 252,'locale' => 'so'],
            ['id' => 197, 'iso' => 'ZA', 'name' => 'SOUTH AFRICA', 'niceName' => 'South Africa','iso3' => 'ZAF','numCode' => 710,'phoneCode' => 27,'locale' => 'af'],
            ['id' => 199, 'iso' => 'ES', 'name' => 'SPAIN', 'niceName' => 'Spain','iso3' => 'ESP','numCode' => 724,'phoneCode' => 34,'locale' => 'gl'],
            ['id' => 200, 'iso' => 'LK', 'name' => 'SRI LANKA', 'niceName' => 'Sri Lanka','iso3' => 'LKA','numCode' => 144,'phoneCode' => 94,'locale' => 'si'],
            ['id' => 201, 'iso' => 'SD', 'name' => 'SUDAN', 'niceName' => 'Sudan','iso3' => 'SDN','numCode' => 736,'phoneCode' => 249,'locale' => 'ar'],
            ['id' => 202, 'iso' => 'SR', 'name' => 'SURINAME', 'niceName' => 'Suriname','iso3' => 'SUR','numCode' => 740,'phoneCode' => 597,'locale' => 'sr'],
            ['id' => 205, 'iso' => 'SE', 'name' => 'SWEDEN', 'niceName' => 'Sweden','iso3' => 'SWE','numCode' => 752,'phoneCode' => 46,'locale' => 'sv'],
            ['id' => 206, 'iso' => 'CH', 'name' => 'SWITZERLAND', 'niceName' => 'Switzerland','iso3' => 'CHE','numCode' => 756,'phoneCode' => 41,'locale' => 'it'],
            ['id' => 207, 'iso' => 'SY', 'name' => 'SYRIAN ARAB REPUBLIC', 'niceName' => 'Syrian Arab Republic','iso3' => 'SYR','numCode' => 760,'phoneCode' => 963,'locale' => 'ar'],
            ['id' => 208, 'iso' => 'TW', 'name' => 'TAIWAN, PROVINCE OF CHINA', 'niceName' => 'Taiwan, Province of China','iso3' => 'TWN','numCode' => 158,'phoneCode' => 886,'locale' => 'zh'],
            ['id' => 210, 'iso' => 'TZ', 'name' => 'TANZANIA, UNITED REPUBLIC OF', 'niceName' => 'Tanzania, United Republic of','iso3' => 'TZA','numCode' => 834,'phoneCode' => 255,'locale' => 'ma'],
            ['id' => 211, 'iso' => 'TH', 'name' => 'THAILAND', 'niceName' => 'Thailand','iso3' => 'THA','numCode' => 764,'phoneCode' => 66,'locale' => 'th'],
            ['id' => 213, 'iso' => 'TG', 'name' => 'TOGO', 'niceName' => 'Togo','iso3' => 'TGO','numCode' => 768,'phoneCode' => 228,'locale' => 'ee'],
            ['id' => 215, 'iso' => 'TO', 'name' => 'TONGA', 'niceName' => 'Tonga','iso3' => 'TON','numCode' => 776,'phoneCode' => 676,'locale' => 'to'],
            ['id' => 216, 'iso' => 'TT', 'name' => 'TRINIDAD AND TOBAGO', 'niceName' => 'Trinidad and Tobago','iso3' => 'TTO','numCode' => 780,'phoneCode' => 1868,'locale' => 'en'],
            ['id' => 217, 'iso' => 'TN', 'name' => 'TUNISIA', 'niceName' => 'Tunisia','iso3' => 'TUN','numCode' => 788,'phoneCode' => 216,'locale' => 'az'],
            ['id' => 218, 'iso' => 'TR', 'name' => 'TURKEY', 'niceName' => 'Turkey','iso3' => 'TUR','numCode' => 792,'phoneCode' => 90,'locale' => 'tr'],
            ['id' => 222, 'iso' => 'UG', 'name' => 'UGANDA', 'niceName' => 'Uganda','iso3' => 'UGA','numCode' => 800,'phoneCode' => 256,'locale' => 'xo'],
            ['id' => 223, 'iso' => 'UA', 'name' => 'UKRAINE', 'niceName' => 'Ukraine','iso3' => 'UKR','numCode' => 804,'phoneCode' => 380,'locale' => 'ru'],
            ['id' => 224, 'iso' => 'AE', 'name' => 'UNITED ARAB EMIRATES', 'niceName' => 'United Arab Emirates','iso3' => 'ARE','numCode' => 784,'phoneCode' => 971,'locale' => 'ar'],
            ['id' => 225, 'iso' => 'GB', 'name' => 'UNITED KINGDOM', 'niceName' => 'United Kingdom','iso3' => 'GBR','numCode' => 826,'phoneCode' => 44,'locale' => 'cy'],
            ['id' => 226, 'iso' => 'US', 'name' => 'UNITED STATES', 'niceName' => 'United States','iso3' => 'USA','numCode' => 840,'phoneCode' => 1,'locale' => 'ha'],
            ['id' => 228, 'iso' => 'UY', 'name' => 'URUGUAY', 'niceName' => 'Uruguay','iso3' => 'URY','numCode' => 858,'phoneCode' => 598,'locale' => 'lu'],
            ['id' => 229, 'iso' => 'UZ', 'name' => 'UZBEKISTAN', 'niceName' => 'Uzbekistan','iso3' => 'UZB','numCode' => 860,'phoneCode' => 998,'locale' => 'uz'],
            ['id' => 231, 'iso' => 'VE', 'name' => 'VENEZUELA', 'niceName' => 'Venezuela','iso3' => 'VEN','numCode' => 862,'phoneCode' => 58,'locale' => 'es'],
            ['id' => 232, 'iso' => 'VN', 'name' => 'VIETNAM', 'niceName' => 'Vietnam','iso3' => 'VNM','numCode' => 704,'phoneCode' => 84,'locale' => 'vi'],
            ['id' => 234, 'iso' => 'VI', 'name' => 'VIRGIN ISLANDS, U.S.', 'niceName' => 'Virgin Islands, U.s.','iso3' => 'VIR','numCode' => 850,'phoneCode' => 1340,'locale' => 'vi'],
            ['id' => 236, 'iso' => 'EH', 'name' => 'WESTERN SAHARA', 'niceName' => 'Western Sahara','iso3' => 'ESH','numCode' => 732,'phoneCode' => 212,'locale' => 'se'],
            ['id' => 237, 'iso' => 'YE', 'name' => 'YEMEN', 'niceName' => 'Yemen','iso3' => 'YEM','numCode' => 887,'phoneCode' => 967,'locale' => 'ar'],
            ['id' => 238, 'iso' => 'ZM', 'name' => 'ZAMBIA', 'niceName' => 'Zambia','iso3' => 'ZMB','numCode' => 894,'phoneCode' => 260,'locale' => 'be'],
            ['id' => 239, 'iso' => 'ZW', 'name' => 'ZIMBABWE', 'niceName' => 'Zimbabwe','iso3' => 'ZWE','numCode' => 716,'phoneCode' => 263,'locale' => 'nd'],
        ];
    }

}
