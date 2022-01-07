                               <table id="myTable" class="text-primary display table tablesorter">
                                <thead class="text-primary">
                                <tr>
                                    <th scope="col">label</th>
                                    <th scope="col">conversion rate</th>
                                    <th scope="col">BTC</th>
                                    <th scope="col">USD</th>
                                    <th scope="col">payment hash</th>
                                    <th scope="col">payment preimage</th>
                                    <th scope="col">status</th>
                                    <th scope="col">msatoshi</th>
                                    <th scope="col">destination</th>
                                    <th scope="col">Created at </th>
                                </tr></thead>
                                <tbody>
                                @foreach($data as $datum)
                                    <tr class="custom_color" >
                                        <!--<td> <a href="javascriptvoid:(0)" data-toggle="modal" data-target="#checkModal" class=""> <input type="checkbox"> {{$datum->transaction_id}}</a></td>-->
                                        
                                        <td>{{$datum->transaction_label}}</td>
                                        <td>{{$datum->conversion_rate}}</td>
                                        <td >{{$datum->transaction_amountBTC}}</td>
                                        <td >{{$datum->transaction_amountUSD}}</td>
                                        <td>{{$datum->payment_hash}}</td>
                                        <td>{{$datum->payment_preimage}}</td>
                                        <td>{{$datum->status}}</td>
                                        <td>{{$datum->msatoshi}}</td>
                                        <td>{{$datum->destination}}</td>
                                        <td>{{$datum->transaction_timestamp}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>