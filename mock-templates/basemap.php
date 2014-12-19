<?php

get_header();
// global $post;
//$framecontent = 

$server_legends=array(
                "legend_30_ff0000,Electric Cable Oil Pit,feature,P,oc_red",
                "legend_01_ff0000,Electric Cable Pit,feature,P,oc_red",
                "legend_31_ff0000,ATC Cable Pit,feature,M,oc_red",
                "legend_32_ff0000,Traffic Light,feature,M,oc_red",
                "legend_02_ff0000,Lamppost,feature,L,oc_red",
                "legend_33_ff0000,Illuminating Bollard,feature,M,oc_red",
                "legend_35_ff0000,TCSS Cable Pit,feature,M,oc_red",
                "legend_03_ff0000,Control Box,feature,P,oc_red",
                "legend_34_ff0000,Public Lighting Pit,feature,P,oc_red",
                "legend_36_000000,Earth Pit,feature,U,oc_dark",
                "legend_37_ffbf00,Cable TV Pit,feature,C,oc_yellow_1",
                "legend_38_dda500,PCCW Pit,feature,T,oc_yellow_2",
                "legend_39_dda500,Hutchison Pit,feature,T,oc_yellow_2",
                "legend_40_dda500,NT&T Pit,feature,T,oc_yellow_2",
                "legend_41_dda500,New World Telecom Pit,feature,T,oc_yellow_2",
                "legend_42_dda500,HKBN Pit,feature,T,oc_yellow_2",
                "legend_43_dda500,Easterstar Pit,feature,T,oc_yellow_2",
                "legend_44_dda500,WT&T Pit,feature,T,oc_yellow_2",
                "legend_45_dda500,TGT Pit,feature,T,oc_yellow_2",
                "legend_46_dda500,TRAX Pit,feature,T,oc_yellow_2",
                "legend_47_dda500,Telephone Kiosk,feature,T,oc_yellow_2",
                "legend_49_ff7f00,Gas Value,feature,G,oc_yellow_3",
                "legend_48_ff7f00,Gas Pit,feature,G,oc_yellow_3",
                "legend_50_0000ff,Fire Hydrant Pit,feature,A,oc_blue_1",
                "legend_51_0000ff,Irrigation Water,feature,A,oc_blue_1",
                "legend_04_0000ff,Meter,feature,A,oc_blue_1",
                "legend_05_0000ff,Water Valve,feature,A,oc_blue_1",
                "legend_52_0000ff,Water Valve Pit,feature,A,oc_blue_1",
                "legend_50_0000ff,Fire Hydrant Pit,feature,B,oc_blue_1",
                "legend_51_0000ff,Irrigation Water,feature,B,oc_blue_1",
                "legend_52_0007fff,Water Valve Pit,feature,B,oc_blue_2",
                "legend_04_007fff,Meter,feature,B,oc_blue_2",
                "legend_59_007fff,Water Valve,feature,B,oc_blue_2",
                "legend_53_4a9500,Storm Manhole,feature,S,oc_green_1",
                "legend_54_a5dd00,Foul Manhole,feature,F,oc_green_2",
                "legend_53_4a9500,Catch-Pit,feature,S,oc_green_1",
                "legend_56_4a9500,Gully,feature,S,oc_green_1",
                "legend_60_000000,Cooling Main Value,feature,U,oc_dark",
                "legend_57_000000,Cooling Main Value Pit/Manhole,feature,U,oc_dark",
                "legend_58_000000,Unclsasified Utility manhole,feature,U,oc_dark",
                "legend_12_ff0000,Electric Cable,line,P,oc_red,ELEC",
                "legend_13_ff0000,E&M/ATC Cable,line,M,oc_red,ATC",
                "legend_14_ff0000,Public Lighting Cable,line,L,oc_red,PL",
                "legend_15_ff0000,TCSS Cable,line,M,oc_red,TCSS",
                "legend_06_ffbf00,Cable TV Cable,line,C,oc_yellow_1,CATV",
                "legend_07_dda500,PCCW Cable,line,T,oc_yellow_2,PCCW",
                "legend_08_dda500,Hutchison Cable,line,T,oc_yellow_2,HGC",
                "legend_09_dda500,NT&T Cable,line,T,oc_yellow_2,NT&T",
                "legend_16_dda500,New World Telecom Cable,line,T,oc_yellow_2,NWT",
                "legend_17_dda500,HKBN Cable,line,T,oc_yellow_2,HKBN",
                "legend_18_dda500,Eaststar Cable,line,T,oc_yellow_2,EASTERSTAR",
                "legend_19_dda500,WT&T Cable,line,T,oc_yellow_2,WT&T",
                "legend_20_dda500,TGT Cable,line,T,oc_yellow_2,TGT",
                "legend_21_dda500,TRAX Cable,line,T,oc_yellow_2,TRAX",
                "legend_22_ff7f00,Gas Pipe,line,G,oc_yellow_2,GAS",
                "legend_10_0000ff,Fresh Water Pipe,line,A,oc_yellow_2,F WAT",
                "legend_11_007fff,Salt Water Pipe,line,B,oc_yellow_2,S WAT",
                "legend_23_0000ff,Irrigation Water Pipe,line,A,oc_yellow_2,IR",
                "legend_24_4a9500,Storm Water Pipe,line,S,oc_yellow_2,STORM",
                "legend_25_a5dd00,Foul Water Pipe,line,F,oc_yellow_2,FOUL",
                "legend_26_000000,Cooling Main Pipe,line,U,oc_yellow_2,COOLING MAIN",
                "legend_27_000000,Unclassified Utility Line,line,U,oc_yellow_2,UN",
                "legend_28_4a9500,U-Channel,line,S,oc_yellow_2,U-C",
                "legend_29_4a9500,S-Channel,line,S,oc_yellow_2,S-C");

$frameurl = HKM_IMG_PATH . "frame.jpg";

?>
<style>
.main_frame_container{position:relative;}
.main_frame_container .base{z-index:1;}
.main_frame_container .content{
top: 118px;
left: 23px;
position:absolute;z-index:10;}
    </style><div id="primary" class="site-content">
    <div id="content" role="main">
        <div class="main_frame_container">
            <div class="base">
                <img src="<?php echo $frameurl; ?>" />
            </div>
            <div class="content">
                <img src="<?php echo $frameurl; ?>" />
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>
