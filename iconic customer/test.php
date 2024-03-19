<?php
function getFormattedQuery($vendorType, $name="company_name") {
				return
				sprintf("SELECT %s.%s, %s_booking.decided_price
				FROM %s
				INNER JOIN %s_booking ON %s.%s_id = %s_booking.%s_id
				WHERE booking_id = ?", $vendorType, $name, $vendorType, $vendorType, $vendorType, $vendorType, $vendorType, $vendorType, $vendorType);
			}

			function getBookingResultSet($vendorType) {
				global $conn;

				if ($vendorType == "venue") {
					$query = getFormattedQuery($vendorType, "venue_name");
				}
				else {
					$query = getFormattedQuery($vendorType);
				}

				$stmt = $conn->prepare($query);
				$stmt->bind_param("i", $bookingId);
				$stmt->execute();

				return $stmt->get_result();
			}

			$rsCaterer = getBookingResultSet("caterer");
			if ($rsCaterer->num_rows > 0) {
				$catererRow = $rsCaterer->fetch_assoc();
			}
			$rsMuscian = getBookingResultSet("musician");
			if ($rsMuscian->num_rows > 0) {
				$muscianRow = $rsMuscian->fetch_assoc();
			}
			$rsPhoto = getBookingResultSet("photographer");
			if ($rsPhoto->num_rows > 0) {
				$photoRow = $rsPhoto->fetch_assoc();
			}
			$rsVenue = getBookingResultSet("venue");
			if ($rsVenue->num_rows > 0) {
				$venueRow = $rsVenue->fetch_assoc();
			}