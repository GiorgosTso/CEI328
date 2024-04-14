                    <?php
                    $sql = "(SELECT * FROM employee)
                    UNION
                    (SELECT * FROM admin)";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-xl-3 col-lg-4 col-md-6">';
                            echo '    <div class="services-caption text-center mb-30" onclick="selectBarber(' . $row["id"] . ')">';
                            echo '        <div class="service-icon" style="background: color #000;">';
                            echo '            <i class="flaticon-healthcare-and-medical"></i>';
                            echo '        </div>';
                            echo '        <div class="service-cap">';
                            echo '            <h2>' . $row["name"] . ' ' . $row["surname"] . '</h2>';
                            echo '            <p> phone: ' . $row["phone"] . '</p>';
                            echo '            <input type="radio" name="selectedBarberId" value="' . $row["id"] . '" class="service-radio" required>';

                            // Conditionally display Edit and Delete buttons for admins

                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 barbers";
                    }

                    ?>