<?php

use App\Ethnic;
use Illuminate\Database\Seeder;

class EthnicTableSeeder extends Seeder
{
    public function run()
    {
    	$etnias = explode(' ','akawayo, amorua, añú/paraujano, arawako, ayaman, baniva, baré, barí, chaima, cubeo, cumanagoto, eñepá/panare, guanono, hoti/hodi, inga, japrería, jivi/guajibo, kariña, kuiba, kurripaco, mako, ñengatú/yeral, pemón, piapoco, puinave, pumé/yaruro, sáliva, sanemá, sape, timoto-cuicas/Timones, uruak/arutani, wanai/mapoyo, warao, warekena, wayuu, wotjuja/piaroa, yabarana, yanomami, yekuana, yukpa, matako, makushí, Caribe, rurripako, waika, waikerí, wapishana, camentza, gayón, guazabara, quinaroe');
    	foreach ($etnias as $name){
        	Ethnic::create(['name'=>str_replace(',', '', $name)]);
    	}
    }
}
