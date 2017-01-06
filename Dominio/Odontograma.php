<?php
class Odontograma
{
 	public function Consultar_Odontograma($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_od"=>$res->fields[0],
			"id_pac"=>$res->fields[1],
			"cdre18_od"=>$res->fields[2],
			"cdmo18_od"=>$res->fields[3],
			"da18_od"=>$res->fields[4],
			"di18_od"=>$res->fields[5],
			"dab18_od"=>$res->fields[6],
			"dd18_od"=>$res->fields[7],
			"dc18_od"=>$res->fields[8],
			
			"cdre17_od"=>$res->fields[9],
			"cdmo17_od"=>$res->fields[10],
			"da17_od"=>$res->fields[11],
			"di17_od"=>$res->fields[12],
			"dab17_od"=>$res->fields[13],
			"dd17_od"=>$res->fields[14],
			"dc17_od"=>$res->fields[15],
			
			"cdre16_od"=>$res->fields[16],
			"cdmo16_od"=>$res->fields[17],
			"da16_od"=>$res->fields[18],
			"di16_od"=>$res->fields[19],
			"dab16_od"=>$res->fields[20],
			"dd16_od"=>$res->fields[21],
			"dc16_od"=>$res->fields[22],
			
			"cdre15_od"=>$res->fields[23],
			"cdmo15_od"=>$res->fields[24],
			"da15_od"=>$res->fields[25],
			"di15_od"=>$res->fields[26],
			"dab15_od"=>$res->fields[27],
			"dd15_od"=>$res->fields[28],
			"dc15_od"=>$res->fields[29],
			
			"cdre14_od"=>$res->fields[30],
			"cdmo14_od"=>$res->fields[31],
			"da14_od"=>$res->fields[32],
			"di14_od"=>$res->fields[33],
			"dab14_od"=>$res->fields[34],
			"dd14_od"=>$res->fields[35],
			"dc14_od"=>$res->fields[36],						


			"cdre13_od"=>$res->fields[37],
			"cdmo13_od"=>$res->fields[38],
			"da13_od"=>$res->fields[39],
			"di13_od"=>$res->fields[40],
			"dab13_od"=>$res->fields[41],
			"dd13_od"=>$res->fields[42],
			"dc13_od"=>$res->fields[43],
			
			"cdre12_od"=>$res->fields[44],
			"cdmo12_od"=>$res->fields[45],
			"da12_od"=>$res->fields[46],
			"di12_od"=>$res->fields[47],
			"dab12_od"=>$res->fields[48],
			"dd12_od"=>$res->fields[49],
			"dc12_od"=>$res->fields[50],

			"cdre11_od"=>$res->fields[51],
			"cdmo11_od"=>$res->fields[52],
			"da11_od"=>$res->fields[53],
			"di11_od"=>$res->fields[54],
			"dab11_od"=>$res->fields[55],
			"dd11_od"=>$res->fields[56],
			"dc11_od"=>$res->fields[57],
			

			"cdre21_od"=>$res->fields[58],
			"cdmo21_od"=>$res->fields[59],
			"da21_od"=>$res->fields[60],
			"di21_od"=>$res->fields[61],
			"dab21_od"=>$res->fields[62],
			"dd21_od"=>$res->fields[63],
			"dc21_od"=>$res->fields[64],
			

			"cdre22_od"=>$res->fields[65],
			"cdmo22_od"=>$res->fields[66],
			"da22_od"=>$res->fields[67],
			"di22_od"=>$res->fields[68],
			"dab22_od"=>$res->fields[69],
			"dd22_od"=>$res->fields[70],
			"dc22_od"=>$res->fields[71],
			
			"cdre23_od"=>$res->fields[72],
			"cdmo23_od"=>$res->fields[73],
			"da23_od"=>$res->fields[74],
			"di23_od"=>$res->fields[75],
			"dab23_od"=>$res->fields[76],
			"dd23_od"=>$res->fields[77],
			"dc23_od"=>$res->fields[78],


			"cdre24_od"=>$res->fields[79],
			"cdmo24_od"=>$res->fields[80],
			"da24_od"=>$res->fields[81],
			"di24_od"=>$res->fields[82],
			"dab24_od"=>$res->fields[83],
			"dd24_od"=>$res->fields[84],
			"dc24_od"=>$res->fields[85],
			
			"cdre25_od"=>$res->fields[86],
			"cdmo25_od"=>$res->fields[87],
			"da25_od"=>$res->fields[88],
			"di25_od"=>$res->fields[89],
			"dab25_od"=>$res->fields[90],
			"dd25_od"=>$res->fields[91],
			"dc25_od"=>$res->fields[92],
			
			"cdre26_od"=>$res->fields[93],
			"cdmo26_od"=>$res->fields[94],
			"da26_od"=>$res->fields[95],
			"di26_od"=>$res->fields[96],
			"dab26_od"=>$res->fields[97],
			"dd26_od"=>$res->fields[98],
			"dc26_od"=>$res->fields[99],
			
			
			"cdre27_od"=>$res->fields[100],
			"cdmo27_od"=>$res->fields[101],
			"da27_od"=>$res->fields[102],
			"di27_od"=>$res->fields[103],
			"dab27_od"=>$res->fields[104],
			"dd27_od"=>$res->fields[105],
			"dc27_od"=>$res->fields[106],
			
			"cdre28_od"=>$res->fields[107],
			"cdmo28_od"=>$res->fields[108],
			"da28_od"=>$res->fields[109],
			"di28_od"=>$res->fields[110],
			"dab28_od"=>$res->fields[111],
			"dd28_od"=>$res->fields[112],
			"dc28_od"=>$res->fields[113],
			

			"da55_od"=>$res->fields[114],
			"di55_od"=>$res->fields[115],
			"dab55_od"=>$res->fields[116],
			"dd55_od"=>$res->fields[117],
			"dc55_od"=>$res->fields[118],
			
			
			"da54_od"=>$res->fields[119],
			"di54_od"=>$res->fields[120],
			"dab54_od"=>$res->fields[121],
			"dd54_od"=>$res->fields[122],
			"dc54_od"=>$res->fields[123],
			
			"da53_od"=>$res->fields[124],
			"di53_od"=>$res->fields[125],
			"dab53_od"=>$res->fields[126],
			"dd53_od"=>$res->fields[127],
			"dc53_od"=>$res->fields[128],

			"da52_od"=>$res->fields[129],
			"di52_od"=>$res->fields[130],
			"dab52_od"=>$res->fields[131],
			"dd52_od"=>$res->fields[132],
			"dc52_od"=>$res->fields[133],
			
			"da51_od"=>$res->fields[134],
			"di51_od"=>$res->fields[135],
			"dab51_od"=>$res->fields[136],
			"dd51_od"=>$res->fields[137],
			"dc51_od"=>$res->fields[138],
			
			"da61_od"=>$res->fields[139],
			"di61_od"=>$res->fields[140],
			"dab61_od"=>$res->fields[141],
			"dd61_od"=>$res->fields[142],
			"dc61_od"=>$res->fields[143],
			
			"da62_od"=>$res->fields[144],
			"di62_od"=>$res->fields[145],
			"dab62_od"=>$res->fields[146],
			"dd62_od"=>$res->fields[147],
			"dc62_od"=>$res->fields[148],
			
			"da63_od"=>$res->fields[149],
			"di63_od"=>$res->fields[150],
			"dab63_od"=>$res->fields[151],
			"dd63_od"=>$res->fields[152],
			"dc63_od"=>$res->fields[153],
			
			"da64_od"=>$res->fields[154],
			"di64_od"=>$res->fields[155],
			"dab64_od"=>$res->fields[156],
			"dd64_od"=>$res->fields[157],
			"dc64_od"=>$res->fields[158],

			"da65_od"=>$res->fields[159],
			"di65_od"=>$res->fields[160],
			"dab65_od"=>$res->fields[161],
			"dd65_od"=>$res->fields[162],
			"dc65_od"=>$res->fields[163],
			
			"da85_od"=>$res->fields[164],
			"di85_od"=>$res->fields[164],
			"dab85_od"=>$res->fields[165],
			"dd85_od"=>$res->fields[166],
			"dc85_od"=>$res->fields[167],

			"da84_od"=>$res->fields[168],
			"di84_od"=>$res->fields[169],
			"dab84_od"=>$res->fields[170],
			"dd84_od"=>$res->fields[171],
			"dc84_od"=>$res->fields[172],
			
			"da83_od"=>$res->fields[173],
			"di83_od"=>$res->fields[174],
			"dab83_od"=>$res->fields[175],
			"dd83_od"=>$res->fields[176],
			"dc83_od"=>$res->fields[177],
			
			"da82_od"=>$res->fields[178],
			"di82_od"=>$res->fields[179],
			"dab82_od"=>$res->fields[180],
			"dd82_od"=>$res->fields[181],
			"dc82_od"=>$res->fields[182],
			
			"da81_od"=>$res->fields[183],
			"di81_od"=>$res->fields[184],
			"dab81_od"=>$res->fields[185],
			"dd81_od"=>$res->fields[186],
			"dc81_od"=>$res->fields[187],
			
			"da71_od"=>$res->fields[188],
			"di71_od"=>$res->fields[189],
			"dab71_od"=>$res->fields[190],
			"dd71_od"=>$res->fields[191],
			"dc71_od"=>$res->fields[192],
			
			"da72_od"=>$res->fields[193],
			"di72_od"=>$res->fields[194],
			"dab72_od"=>$res->fields[195],
			"dd72_od"=>$res->fields[196],
			"dc72_od"=>$res->fields[197],
			
			"da73_od"=>$res->fields[198],
			"di73_od"=>$res->fields[199],
			"dab73_od"=>$res->fields[200],
			"dd73_od"=>$res->fields[201],
			"dc73_od"=>$res->fields[202],
			
			"da74_od"=>$res->fields[203],
			"di74_od"=>$res->fields[204],
			"dab74_od"=>$res->fields[205],
			"dd74_od"=>$res->fields[206],
			"dc74_od"=>$res->fields[207],
			
			"da75_od"=>$res->fields[208],
			"di75_od"=>$res->fields[209],
			"dab75_od"=>$res->fields[210],
			"dd75_od"=>$res->fields[211],
			"dc75_od"=>$res->fields[212],
			
			"cdre48_od"=>$res->fields[213],
			"cdmo48_od"=>$res->fields[214],
			"da48_od"=>$res->fields[215],
			"di48_od"=>$res->fields[216],
			"dab48_od"=>$res->fields[217],
			"dd48_od"=>$res->fields[218],
			"dc48_od"=>$res->fields[219],
			
			"cdre47_od"=>$res->fields[220],
			"cdmo47_od"=>$res->fields[221],
			"da47_od"=>$res->fields[222],
			"di47_od"=>$res->fields[223],
			"dab47_od"=>$res->fields[224],
			"dd47_od"=>$res->fields[225],
			"dc47_od"=>$res->fields[226],
			
			"cdre46_od"=>$res->fields[227],
			"cdmo46_od"=>$res->fields[228],
			"da46_od"=>$res->fields[229],
			"di46_od"=>$res->fields[230],
			"dab46_od"=>$res->fields[231],
			"dd46_od"=>$res->fields[232],
			"dc46_od"=>$res->fields[233],
			
			"cdre45_od"=>$res->fields[234],
			"cdmo45_od"=>$res->fields[235],
			"da45_od"=>$res->fields[236],
			"di45_od"=>$res->fields[237],
			"dab45_od"=>$res->fields[238],
			"dd45_od"=>$res->fields[239],
			"dc45_od"=>$res->fields[240],
			
			"cdre44_od"=>$res->fields[241],
			"cdmo44_od"=>$res->fields[242],
			"da44_od"=>$res->fields[243],
			"di44_od"=>$res->fields[244],
			"dab44_od"=>$res->fields[245],
			"dd44_od"=>$res->fields[246],
			"dc44_od"=>$res->fields[247],
			
			"cdre43_od"=>$res->fields[248],
			"cdmo43_od"=>$res->fields[249],
			"da43_od"=>$res->fields[250],
			"di43_od"=>$res->fields[251],
			"dab43_od"=>$res->fields[252],
			"dd43_od"=>$res->fields[253],
			"dc43_od"=>$res->fields[254],
			
			"cdre42_od"=>$res->fields[255],
			"cdmo42_od"=>$res->fields[256],
			"da42_od"=>$res->fields[257],
			"di42_od"=>$res->fields[258],
			"dab42_od"=>$res->fields[259],
			"dd42_od"=>$res->fields[260],
			"dc42_od"=>$res->fields[261],
			
			"cdre41_od"=>$res->fields[262],
			"cdmo41_od"=>$res->fields[263],
			"da41_od"=>$res->fields[264],
			"di41_od"=>$res->fields[265],
			"dab41_od"=>$res->fields[266],
			"dd41_od"=>$res->fields[267],
			"dc41_od"=>$res->fields[268],
			
			"cdre31_od"=>$res->fields[269],
			"cdmo31_od"=>$res->fields[270],
			"da31_od"=>$res->fields[271],
			"di31_od"=>$res->fields[272],
			"dab31_od"=>$res->fields[273],
			"dd31_od"=>$res->fields[274],
			"dc31_od"=>$res->fields[275],
			
			"cdre32_od"=>$res->fields[276],
			"cdmo32_od"=>$res->fields[277],
			"da32_od"=>$res->fields[278],
			"di32_od"=>$res->fields[279],
			"dab32_od"=>$res->fields[280],
			"dd32_od"=>$res->fields[281],
			"dc32_od"=>$res->fields[282],
			
			"cdre33_od"=>$res->fields[283],
			"cdmo33_od"=>$res->fields[284],
			"da33_od"=>$res->fields[285],
			"di33_od"=>$res->fields[286],
			"dab33_od"=>$res->fields[287],
			"dd33_od"=>$res->fields[288],
			"dc33_od"=>$res->fields[289],
			
			"cdre34_od"=>$res->fields[290],
			"cdmo34_od"=>$res->fields[291],
			"da34_od"=>$res->fields[292],
			"di34_od"=>$res->fields[293],
			"dab34_od"=>$res->fields[294],
			"dd34_od"=>$res->fields[295],
			"dc34_od"=>$res->fields[296],
			
			"cdre35_od"=>$res->fields[297],
			"cdmo35_od"=>$res->fields[298],
			"da35_od"=>$res->fields[299],
			"di35_od"=>$res->fields[300],
			"dab35_od"=>$res->fields[301],
			"dd35_od"=>$res->fields[302],
			"dc35_od"=>$res->fields[303],
			
			"cdre36_od"=>$res->fields[304],
			"cdmo36_od"=>$res->fields[305],
			"da36_od"=>$res->fields[306],
			"di36_od"=>$res->fields[307],
			"dab36_od"=>$res->fields[308],
			"dd36_od"=>$res->fields[309],
			"dc36_od"=>$res->fields[310],
			
			"cdre37_od"=>$res->fields[311],
			"cdmo37_od"=>$res->fields[312],
			"da37_od"=>$res->fields[313],
			"di37_od"=>$res->fields[314],
			"dab37_od"=>$res->fields[315],
			"dd37_od"=>$res->fields[316],
			"dc37_od"=>$res->fields[317],
			
			"cdre38_od"=>$res->fields[318],
			"cdmo38_od"=>$res->fields[319],
			"da38_od"=>$res->fields[320],
			"di38_od"=>$res->fields[321],
			"dab38_od"=>$res->fields[322],
			"dd38_od"=>$res->fields[323],
			"dc38_od"=>$res->fields[324]						
			
			);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
	public function Consultar($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		return $res->fields[0];
	}
	public function Ejecutar($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		if(!$res)
		{
			return $con->ErrorMsg();
		}
		else
		{
			return "La informacion se ejecuto correctamente";
		}
	}
	
	
}
?>