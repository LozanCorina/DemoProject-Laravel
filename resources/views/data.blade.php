@extends('layouts.headerOracle')
@section('content')
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Tabelele disponibile:</p>
                <table class="table table-striped">
{{--                    <p>{{$stid}}</p>--}}
                    <tbody>
                    <?php
                    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                        echo "<tr>\n";
                        foreach ($row as $item) {
                            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        }
                        echo "</tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
