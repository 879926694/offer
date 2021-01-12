<html>
<style type="text/css">

    #out{
        position:absolute; top:30%;left:50%; margin-top:-100px; margin-left:-200px;
    }

</style>
<body>
<div id="out">
    <table border="1">
        <tr>
            <th colspan="5">{{ $name }} {{$date}} 地铁消费</th>
        </tr>
        <tr>
            <th>单程票价</th>
            <th>工作天数</th>
            <th>8折天数</th>
            <th>5折天数</th>
            <th>总价</th>
        </tr>
        <tr>
            <td>{{ $dateData['ticket'] }}</td>
            <td>{{ $dateData['days'] }}</td>
            <td>
                @if ($dateData['enjoy80']>0)
                    使用第{{ $dateData['enjoy80'] }}天可享受8折
                @else
                    无法享受8折
                @endif
            </td>
            <td>
                @if ($dateData['enjoy50']>0)
                    使用第{{ $dateData['enjoy50'] }}天可享受5折
                @else
                    无法享受5折
                @endif
            </td>
            <td>{{ $dateData['total'] }}</td>
        </tr>

        @if ($dayData)
            <tr>
                <th colspan="5">{{ $name }} 单月工作{{$dayData['days']}}天 地铁消费</th>
            </tr>
            <tr>
                <th>单程票价</th>
                <th>工作天数</th>
                <th>8折天数</th>
                <th>5折天数</th>
                <th>总价</th>
            </tr>
            <tr>
                <td>{{ $dayData['ticket'] }}</td>
                <td>{{ $dayData['days'] }}</td>
                <td>
                    @if ($dayData['enjoy80']>0)
                        使用第{{ $dayData['enjoy80'] }}天可享受8折
                    @else
                        无法享受8折
                    @endif
                </td>
                <td>
                    @if ($dayData['enjoy50']>0)
                        使用第{{ $dayData['enjoy50'] }}天可享受5折
                    @else
                        无法享受5折
                    @endif

                </td>
                <td>{{ $dayData['total'] }}</td>
            </tr>
        @endif
    </table>
</div>
{{--<div style="margin-left:50%; margin-top:30%;">--}}
    {{--<a href="/forKobe/{{$id}}" style="font-size: 1px;">24</a>--}}
{{--</div>--}}

</body>
</html>
