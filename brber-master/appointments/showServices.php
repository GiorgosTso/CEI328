<?php
                    
                    include "../php/config.php";

                    $sql = "SELECT serviceId, name, price, time FROM service";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-xl-3 col-lg-4 col-md-6">';
                            echo '    <div class="services-caption text-center mb-30" onclick="selectService('.$row["serviceId"].')">';
                            echo '        <div class="service-icon" style="background: color #000;">';
                            echo '            <i class="flaticon-healthcare-and-medical"></i>';
                            echo '        </div>';
                            echo '        <div class="service-cap">';
                            echo '            <h4><a href="#">' . $row["name"] . '</a></h4>';
                            echo '            <p>' . $row["time"] . ' minutes - €' . $row["price"] . '</p>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 services";
                    }
                    
                    ?>