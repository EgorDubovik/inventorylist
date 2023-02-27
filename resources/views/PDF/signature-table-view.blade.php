<table class="sign-table">
    <tr >
        <td style="width:8%;" rowspan="2"><p class="s12" style="padding-top: 7pt;text-indent: 8pt;text-align: center;">AT ORIGIN</p></td>
        @if($category->signatures->contains('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN))
            <td style="width:30%">
                <p>CARRIER SIGNATURE</p>
                <p class="signature" class="signature">
                    <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN)->first()->signature}}">
                </p>
            </td>
            <td style="width:11%">
                <p style="text-align: center">DATE</p>
                <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_ORIGIN)->first()->updated_at)->format('m/d/Y')}}</p>
            </td>
        @else
            <td style="width:30%">
                <p>CARRIER SIGNATURE</p>
                <p class="signature"></p>
            </td>
            <td style="width:11%"><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
        @endif
        <td style="width:8%" rowspan="2"><p class="s13" style="padding-top: 7pt;text-indent: 0pt;text-align: center;">AT DESTINATION</p></td>
        @if($category->signatures->contains('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION))
            <td style="width: 30%">
                <p>CARRIER SIGNATURE</p>
                <p class="signature">
                    <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION)->first()->signature}}">
                </p>
            </td>
            <td style="width:11%">
                <p style="text-align: center">DATE</p>
                <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CARRIER_AT_DESTINATION)->first()->updated_at)->format('m/d/Y')}}</p>
            </td>
        @else
            <td style="width:30%">
                <p>CARRIER SIGNATURE</p>
                <p class="signature"></p>
            </td>
            <td style="width:11%"><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
        @endif
    </tr>
    <tr >
        @if($category->signatures->contains('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN))
            <td>
                <p>CUSTOMER SIGNATURE</p>
                <p class="signature">
                    <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN)->first()->signature}}">
                </p>
            </td>
            <td>
                <p style="text-align: center">DATE</p>
                <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_ORIGIN)->first()->updated_at)->format('m/d/Y')}}</p>
            </td>
        @else
            <td>
                <p>CUSTOMER SIGNATURE</p>
                <p class="signature"></p>
            </td>
            <td><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
        @endif
        @if($category->signatures->contains('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION))
            <td>
                <p>CUSTOMER SIGNATURE</p>
                <p class="signature">
                    <img width="79" src="{{$category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION)->first()->signature}}">
                </p>
            </td>
            <td>
                <p style="text-align: center">DATE</p>
                <p style="text-align: center;padding-top: 5px;font-size: 10px;">{{\Carbon\Carbon::parse($category->signatures->where('wh',\App\Models\Signatures::CUSTOMER_AT_DESTINATION)->first()->updated_at)->format('m/d/Y')}}</p>
            </td>
        @else
            <td>
                <p>CUSTOMER SIGNATURE</p>
                <p class="signature"></p>
            </td>
            <td><p class="s5" style="padding-left: 27pt;text-indent: 0pt;line-height: 7pt;text-align: left;">DATE</p></td>
        @endif
    </tr>
</table>
