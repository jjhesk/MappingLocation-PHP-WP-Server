<script>
    function changeType(type) {
        if (type == "a") {
            document.getElementById("table").innerHTML = "<table border=1px ><tr><th rowspan=2 >Point ref.</th><th rowspan=2 >Width (mm) (if known)</th><th rowspan=2 >Estimated Depth (m)</th><th colspan=4 >Distance Between A - B:</th><th colspan=2 >Remarks</th></tr><tr><th colspan=2 >From Point A (m)</th><th colspan=2 >From Point B (m)</th><th></th><th></th></tr><tr><td>P19</td><td>-</td><td>1.40</td><td colspan=2 >1.50</td><td colspan=2 >5.00</td><td rowspan=4>1. It’s 132 kV bundle of cables and the outermost cable near Nullah was detected by utilizing Transmitter.</td><td>4</td></tr><tr><td>P20</td><td>-</td><td>1.40</td><td colspan=2 >-7.25</td><td colspan=2 >4.99</td><td>4</td></tr><tr><td>P21</td><td>-</td><td>1.40</td><td colspan=2 >-12.00</td><td colspan=2 >4.98</td><td>4</td></tr><tr><td>P20</td><td>-</td><td>1.40</td><td colspan=2 >-17.50</td><td colspan=2 >4.85</td><td>4</td></tr></table>";
        } else if (type == "b") {
            document.getElementById("table").innerHTML = "<table border=1px ><tr><th rowspan=2 >Point ref.</th><th rowspan=2 >Width (mm) (if known)</th><th rowspan=2 >Estimated Depth (m)</th><th colspan=4 >Distance Between A - B:</th><th colspan=2 >Remarks</th></tr><tr><th colspan=2 >From Point A (m)</th><th colspan=2 >From Point B (m)</th><th></th><th></th></tr><tr><td>P23</td><td>-</td><td>1.50</td><td colspan=2 >-24.00</td><td colspan=2 >4.73</td><td rowspan=6>2.Updated HEC record (valid from date printed out) is needed for electrical supply lines’ protection in accordance with Regulation Cap 406H.</td><td>4</td></tr><tr><td>P24</td><td>-</td><td>1.60</td><td colspan=2 >-31.00</td><td colspan=2 >4.70</td><td>4</td></tr><tr><td>P25</td><td>-</td><td>1.70</td><td colspan=2 >-39.30</td><td colspan=2 >4.68</td><td>4</td></tr><tr><td>P26</td><td>-</td><td>1.70</td><td colspan=2 >-45.60</td><td colspan=2 >4.93</td><td>4</td></tr><tr><td>P27</td><td>-</td><td>1.70</td><td colspan=2 >-51.00</td><td colspan=2 >5.07</td><td>4</td></tr><tr><td>P28</td><td>-</td><td>1.70</td><td colspan=2 >-57.50</td><td colspan=2 >5.24</td><td>4</td></tr></table>";
        } else if (type == "c") {
            document.getElementById("table").innerHTML = "<table border=1px ><tr><th rowspan=2 >Point ref.</th><th rowspan=2 >Width (mm) (if known)</th><th rowspan=2 >Estimated Depth (m)</th><th colspan=4 >Distance Between A - B:</th><th colspan=2 >Remarks</th></tr><tr><th colspan=2 >From Point A (m)</th><th colspan=2 >From Point B (m)</th><th></th><th></th></tr><tr><td>P29</td><td>-</td><td>1.70</td><td colspan=2 >-63.00</td><td colspan=2 >5.19</td><td rowspan=5></td><td>4</td></tr><tr><td>P30</td><td>-</td><td>1.70</td><td colspan=2 >-70.50</td><td colspan=2 >5.33</td><td>4</td></tr><tr><td>P31</td><td>-</td><td>1.70</td><td colspan=2 >76.50</td><td colspan=2 >5.46</td><td>4</td></tr><tr><td>P32</td><td>-</td><td>1.75</td><td colspan=2 >-82.50</td><td colspan=2 >5.86</td><td>4</td></tr><tr><td>P32</td><td>-</td><td>1.75</td><td colspan=2 >-87.00</td><td colspan=2 >5.80</td><td>4</td></tr></table>";
        }

    }

</script>
<script id="tpl_row_A" type="text/x-handlebars-template">
    <tr>
        <td>P19</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2>1.50</td>
        <td colspan=2>5.00</td>
        <td rowspan=4>
            1. It’s 132 kV bundle of cables
            and the outermost cable near Nullah
            was detected by utilizing Transmitter.
        </td>
        <td>4</td>
    </tr>
</script>
<script id="tpl_row_B" type="text/x-handlebars-template">
    <tr>
        <td>P23</td>
        <td>-</td>
        <td>1.50</td>
        <td colspan=2>-24.00</td>
        <td colspan=2>4.73</td>
        <td rowspan=6>2.Updated HEC record (valid from date printed out) is needed for electrical supply lines’
            protection in accordance with Regulation Cap 406H.
        </td>
        <td>4</td>
    </tr>
</script>
<script id="tpl_row_C" type="text/x-handlebars-template">
    <tr>
        <td>P29</td>
        <td>-</td>
        <td>1.70</td>
        <td colspan=2>-63.00</td>
        <td colspan=2>5.19</td>
        <td rowspan=5></td>
        <td>4</td>
    </tr>
</script>
<select onchange="changeType(this.options[this.options.selectedIndex].value)">
    <option value="a">Type A</option>
    <option value="b">Type B</option>
    <option value="c">Type C</option>
</select>
<div id="table">
<table border=1px>
    <tr>
        <th rowspan=2>Point ref.</th>
        <th rowspan=2>Width (mm) (if known)</th>
        <th rowspan=2>Estimated Depth (m)</th>
        <th colspan=4>Distance Between A - B:</th>
        <th colspan=2>Remarks</th>
    </tr>
    <tr>
        <th colspan=2>From Point A (m)</th>
        <th colspan=2>From Point B (m)</th>
        <th>&nbsp</th>
        <th>&nbsp</th>
    </tr>

    <tr>
        <td>P19</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2>1.50</td>
        <td colspan=2>5.00</td>
        <td rowspan=4>
            1. It’s 132 kV bundle of cables
            and the outermost cable near Nullah
            was detected by utilizing Transmitter.
        </td>
        <td>4</td>
    </tr>
    <tr>
        <td>P20</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2>-7.25</td>
        <td colspan=2>4.99</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P21</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2>-12.00</td>
        <td colspan=2>4.98</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P20</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2>-17.50</td>
        <td colspan=2>4.85</td>
        <td>4</td>
    </tr>
</table>
<!-- a
<table border=1px >
    <tr>
        <th rowspan=2 >Point ref.</th>
        <th rowspan=2 >Width (mm) (if known)</th>
        <th rowspan=2 >Estimated Depth (m)</th>
        <th colspan=4 >Distance Between A - B:</th>
        <th colspan=2 >Remarks</th>
    </tr>
    <tr>
        <th colspan=2 >From Point A (m)</th>
        <th colspan=2 >From Point B (m)</th>
        <th>&nbsp</th>
        <th>&nbsp</th>
    </tr>

    <tr>
        <td>P19</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2 >1.50</td>
        <td colspan=2 >5.00</td>
        <td rowspan=4>
            1. It’s 132 kV bundle of cables
            and the outermost cable near Nullah
            was detected by utilizing Transmitter.
        </td>
        <td>4</td>
    </tr>
    <tr>
        <td>P20</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2 >-7.25</td>
        <td colspan=2 >4.99</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P21</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2 >-12.00</td>
        <td colspan=2 >4.98</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P20</td>
        <td>-</td>
        <td>1.40</td>
        <td colspan=2 >-17.50</td>
        <td colspan=2 >4.85</td>
        <td>4</td>
    </tr>
</table> -->

<!-- b
<table border=1px >
<tr>
    <th rowspan=2 >Point ref.</th>
    <th rowspan=2 >Width (mm) (if known)</th>
    <th rowspan=2 >Estimated Depth (m)</th>
    <th colspan=4 >Distance Between A - B:</th>
    <th colspan=2 >Remarks</th>
</tr>
<tr>
    <th colspan=2 >From Point A (m)</th>
    <th colspan=2 >From Point B (m)</th>
    <th>&nbsp</th>
    <th>&nbsp</th>
</tr>

<tr>
    <td>P23</td>
    <td>-</td>
    <td>1.50</td>
    <td colspan=2 >-24.00</td>
    <td colspan=2 >4.73</td>
    <td rowspan=6>
        2.Updated HEC record (valid from date printed out)
        is needed for electrical supply lines’ protection
        in accordance with Regulation Cap 406H.
    </td>
    <td>4</td>
</tr>
<tr>
    <td>P24</td>
    <td>-</td>
    <td>1.60</td>
    <td colspan=2 >-31.00</td>
    <td colspan=2 >4.70</td>
    <td>4</td>
</tr>
<tr>
    <td>P25</td>
    <td>-</td>
    <td>1.70</td>
    <td colspan=2 >-39.30</td>
    <td colspan=2 >4.68</td>
    <td>4</td>
</tr>
<tr>
    <td>P26</td>
    <td>-</td>
    <td>1.70</td>
    <td colspan=2 >-45.60</td>
    <td colspan=2 >4.93</td>
    <td>4</td>
</tr>
<tr>
    <td>P27</td>
    <td>-</td>
    <td>1.70</td>
    <td colspan=2 >-51.00</td>
    <td colspan=2 >5.07</td>
    <td>4</td>
</tr>
<tr>
    <td>P28</td>
    <td>-</td>
    <td>1.70</td>
    <td colspan=2 >-57.50</td>
    <td colspan=2 >5.24</td>
    <td>4</td>
</tr>
</table>
-->

<!-- c
<table border=1px >
    <tr>
        <th rowspan=2 >Point ref.</th>
        <th rowspan=2 >Width (mm) (if known)</th>
        <th rowspan=2 >Estimated Depth (m)</th>
        <th colspan=4 >Distance Between A - B:</th>
        <th colspan=2 >Remarks</th>
    </tr>
    <tr>
        <th colspan=2 >From Point A (m)</th>
        <th colspan=2 >From Point B (m)</th>
        <th>&nbsp</th>
        <th>&nbsp</th>
    </tr>

    <tr>
        <td>P29</td>
        <td>-</td>
        <td>1.70</td>
        <td colspan=2 >-63.00</td>
        <td colspan=2 >5.19</td>
        <td rowspan=5>
            &nbsp
        </td>
        <td>4</td>
    </tr>
    <tr>
        <td>P30</td>
        <td>-</td>
        <td>1.70</td>
        <td colspan=2 >-70.50</td>
        <td colspan=2 >5.33</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P31</td>
        <td>-</td>
        <td>1.70</td>
        <td colspan=2 >76.50</td>
        <td colspan=2 >5.46</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P32</td>
        <td>-</td>
        <td>1.75</td>
        <td colspan=2 >-82.50</td>
        <td colspan=2 >5.86</td>
        <td>4</td>
    </tr>
    <tr>
        <td>P32</td>
        <td>-</td>
        <td>1.75</td>
        <td colspan=2 >-87.00</td>
        <td colspan=2 >5.80</td>
        <td>4</td>
    </tr>
</table>
-->

</div>