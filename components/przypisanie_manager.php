<?php
if ($doc['docSpace'] === "kierownik" && $doc['workerAsigned'] ==="→") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 &nbsp;X |
					</label>
					<label>
						X||
					</label>
					<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" >
					</label>';
						} elseif ($doc['docSpace'] === "pracownik" && $doc['progress'] === "K") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 &nbsp;X |
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik" checked="checked" onclick="javascript: return false;" >||
					</label>
					<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" >
					</label>';
						}elseif ($doc['docSpace'] === "kierownik") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 &nbsp;X |
					</label>
					<label>
						X||
					</label>
					<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" checked="checked" value="kierownik" >
					</label>';
						} elseif ($doc['docSpace'] === "pracownik" && $doc['progress'] === "K") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 &nbsp;X |
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik" checked="checked" onclick="javascript: return false;" >||
					</label>
					<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'kierownik" value="kierownik" >
					</label>';
						}
						elseif ($doc['docSpace'] === "archiwum1") { echo'<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum1" value="archiwum1" checked="checked" onclick="javascript: return false;" > |
					</label>
					<label>
						 &nbsp;X |
					</label>
					<label>
						X||
					</label>
					<label>
						 &nbsp;X &nbsp;
					</label>';
						} elseif ($doc['docSpace'] === "archiwum2") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 <input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'archiwum2" value="archiwum2" checked="checked" onclick="javascript: return false;" > |
					</label>
					<label>
						X||
					</label>
					<label>
						 &nbsp;X &nbsp;
					</label>';
						} elseif ($doc['docSpace'] === "pracownik") { echo'<label>
						 &nbsp;&nbsp;X |
					</label>
					<label>
						 &nbsp;X&nbsp;|
					</label>
					<label>
						<input type="radio" name="docSpace['.$currId.']" id="id'.$currId.'pracownik" value="pracownik" checked="checked" onclick="javascript: return false;" >||
					</label>
					<label>
						 &nbsp;X &nbsp;
					</label>'; 
						}
					?>