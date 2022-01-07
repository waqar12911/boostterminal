                            <table id="myTable" class="text-primary display table tablesorter "  >
                                <thead class="text-primary">
                                <tr>
                                    <th scope="col" style="white-space: nowrap; "><input type="checkbox" class="hideAllCheckBox" name="all" id="checkall" />Check All</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">label</th>
                                    <th scope="col">BTC</th>
                                    <th scope="col">USD</th>
                                    <th scope="col">client Id</th>
                                    <th scope="col">merchant Id </th>
                                    <th scope="col">merchant remaining</th>
                                    <th scope="col">client remaining</th>
                                    <th scope="col">Created at </th>
                                </tr></thead>
                                <tbody id="bootBody">
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <td><input type="checkbox" class="cb-element hideAllCheckBox" name="dataEmail[]" value="{{$datum->id}}" /></td>
                                        <td>{{$datum->transaction_id}}</td>
                                        <td>{{$datum->transaction_label}}</td>
                                        <td >{{number_format((float) "$datum->transaction_amountBTC", 9)}}</td>
                                        <td >{{$datum->transaction_amountUSD}}</td>
                                        <td>{{$datum->transaction_clientId}}</td>
                                        <td>{{$datum->transaction_merchantId}}</td>
                                        <td>{{$datum->merchant_remaining}}</td>
                                        <td>{{$datum->client_remaining}}</td>
                                        <td>{{$datum->created_at}}</td>
                                       
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>