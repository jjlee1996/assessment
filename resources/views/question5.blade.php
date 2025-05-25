<!DOCTYPE html>
<html>

<head>
    <title>Question 5</title>
    <link rel="stylesheet" href="{{ asset('css/question5.css') }}">
</head>

<body>
    <h1>Question 5</h1>
    <div class="container">
        <ol>
            <li><label>Is this a good database design? Why?</label></li>
            <p>No, this db only support single item as each ORDERID only bind to one item and naming issue for column.
            </p>
            <li><label>If your answer to question 1 is no, what can you propose to improve the design?</label></li>
            <p>
                UNIT PRICE need to rename to UNIT_PRICE. <br>
                ITEM, QUANTITY & UNIT_PRICE need to split from TBL_TRANSACTIONS to a new table TBL_TRANSACTIONS_ITEMS to
                support multiple item.<br>
                A new column USERID should insert into TBL_TRANSACTIONS and drop TBL_ORDERS because it just link USERID
                and ORDERID.
            </p>
            <table>
                <thead>
                    <tr>
                        <th>TBL_CUSTOMERS</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>CUSTOMER_ID (PK)</td>
                    </tr>
                    <tr>
                        <td>NAME</td>
                    </tr>
                    <tr>
                        <td>ADDRESS</td>
                    </tr>
                    <tr>
                        <td>AGE</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>TBL_TRANSACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>TRANSACTION_ID (PK)</td>
                    </tr>
                    <tr>
                        <td>CUSTOMER_ID (FK)</td>
                    </tr>
                    <tr>
                        <td>TRANSACTION_DATE</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>TBL_TRANSACTIONS_ITEMS</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>TRANSACTION_ITEM_ID (PK)</td>
                    </tr>
                    <tr>
                        <td>TRANSACTION_ID (FK)</td>
                    </tr>
                    <tr>
                        <td>ITEM</td>
                    </tr>
                    <tr>
                        <td>QUANTITY</td>
                    </tr>
                    <tr>
                        <td>UNIT_PRICE</td>
                    </tr>
                </tbody>
            </table>
            <li><label>Write a SQL query based on the above schema to retrieve information about the following
                    items. Assume that the TRANSACTION_DATE column is in the UTC time zone. We need to
                    generate reports in Malaysia time.</label>
                <ul>
                    <li type="a">Who is the top spender in this online store?</li>
                    <pre>
                        <code>
                        SELECT
                            C.`USERID`,
                            C.`NAME`,
                            SUM(T.`QUANTITY` * T.`UNIT PRICE`) AS TOTAL_SPENT
                        FROM
                            tbl_customers AS C
                        JOIN tbl_orders AS O
                            ON C.`USERID` = O.`USERID`
                        JOIN tbl_transactions AS T
                            ON O.`ORDERID` = T.`ORDERID`
                        GROUP BY
                            C.`USERID`
                        ORDER BY
                            `TOTAL_SPENT` DESC
                        LIMIT 1;
                        </code>
                    </pre>
 
                    <li type="a">Tell me the number of transactions in each hour of the day.</li>
                    <pre>
                        <code>
                        SELECT 
                            HOUR(CONVERT_TZ(T.`TRANSACTION_DATE`, '+00:00', '+08:00')) AS HOUR,
                            COUNT(*) AS NO_OF_TRANSACTION
                        FROM 
                            tbl_transactions AS T
                        GROUP BY 
                            HOUR
                        ORDER BY 
                            HOUR;
                        </code>
                    </pre>

                    <li type="a">What kind of fruits (item) did Adam buy so far?</li>
                    <pre>
                        <code>
                        SELECT DISTINCT 
                            T.`ITEM`
                        FROM 
                            tbl_customers AS C
                        JOIN 
                            tbl_orders AS O ON C.`USERID` = O.`USERID`
                        JOIN 
                            tbl_transactions AS T ON O.`ORDERID` = T.`ORDERID`
                        WHERE 
                            C.`NAME` = 'Adam';
                        </code>
                    </pre>
                </ul>

            </li>

        </ol>

    </div>
</body>

</html>
