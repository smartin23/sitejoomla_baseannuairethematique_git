<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>
<xsl:include href="vcard.xsl" />

	<xsl:template name="entriesLoop">
	<div class="spEntriesListContainer">
	
	<div id="entriesaccordion" class="accordion">
	
		<xsl:variable name="entriesInLine">
			<xsl:value-of select="entries_in_line" />
		</xsl:variable>
		<xsl:variable name="eCellWidth">
			<xsl:value-of select="(100 div $entriesInLine) -5" />
		</xsl:variable>
		<xsl:variable name="entriesCount">
			<xsl:value-of select="count(entries/entry)" />
		</xsl:variable>

		<ul class='content'>
		<xsl:for-each select="entries/entry">
			<li>
			<div class="accordion-group">
				<div class="accordion-heading">

					<xsl:if test="string-length(fields/field_logo/data/@thumbnail) &gt; 0">
						<a class="accordion-toogle" data-toggle="collapse" data-parent="#entriesaccordion">
						<xsl:attribute name="href">
							<xsl:text>#collapse</xsl:text>
							<xsl:value-of select="position()" />
						</xsl:attribute>
							<div id="logo" class="SPField">							
								<xsl:element name="img">
								  <xsl:attribute name="src">
								  <xsl:value-of select="fields/field_logo/data/@thumbnail" />
								  </xsl:attribute>
								  <xsl:attribute name="alt">
								  <xsl:choose>
										  <xsl:when test="string-length(name) &gt; 0">
											<xsl:value-of select="name" />
										  </xsl:when>
										  <xsl:otherwise>
											<xsl:value-of select="fields/field_name/data" />
										  </xsl:otherwise>
										</xsl:choose>
								  </xsl:attribute>
								</xsl:element>							
							</div>
						</a>
					</xsl:if>
						
						<div id="header">
							
								<div class="header-left">
									
									<a class="accordion-toogle" data-toggle="collapse" data-parent="#entriesaccordion">
									<xsl:attribute name="href">
										<xsl:text>#collapse</xsl:text>
										<xsl:value-of select="position()" />
									</xsl:attribute>
									<div class="spField" id="titre">
										<xsl:choose>
										  <xsl:when test="string-length(name) &gt; 0">
											<xsl:value-of select="name" />
										  </xsl:when>
										  <xsl:otherwise>
											<xsl:value-of select="fields/field_name/data" />
										  </xsl:otherwise>
										</xsl:choose>
									</div>
									</a>
									
									<div class="spField" id="localisation">
								  <span>
									  <xsl:value-of select="fields/field_zip/data"/>
									  <xsl:text> </xsl:text>
									  <xsl:value-of select="fields/field_zip/@suffix"/>
								  </span>
								  <span>
									  <xsl:value-of select="fields/field_city/data"/>
									  <xsl:text> </xsl:text>
									  <xsl:value-of select="fields/field_city/@suffix"/>
								  </span>
									</div>
														
									<div class="spField" id="categorie">
									<xsl:if test="count(categories)">		
										<ul>
										<xsl:for-each select="categories/category">
										  <li><xsl:value-of select="." /></li>
										  
										</xsl:for-each>	
										</ul>
									</xsl:if>
									</div>	
								</div>
								
								<div class="header-right">
									<div class="localisation">
										<div class="marker"></div>
										<div class="spField" id="distance" ><xsl:value-of select="mjradius" disable-output-escaping="yes" /></div>
									</div>
								</div>
								
							<div style="clear:both;"/>
							
							<div class="header-bottom">				
								<div class="spField" id="rating"><xsl:call-template name="ratingStars"/></div>
							</div>
								
						</div>

				</div>
				<div style="clear:both;"/>
				<div class="accordion-body">
					<xsl:attribute name="class">
						<xsl:choose>
							<xsl:when test="position() = 1">accordion-body collapse</xsl:when>
							<xsl:otherwise>accordion-body collapse</xsl:otherwise>
						</xsl:choose>
					</xsl:attribute>
					<xsl:attribute name="id">
						<xsl:text>collapse</xsl:text>
						<xsl:value-of select="position()" />		
					</xsl:attribute>
					<div class="accordion-inner">
					
						<xsl:if test="$entriesInLine > 1 and ( position() = 1 or ( position() mod $entriesInLine ) = 1 )">
							<!-- opening the "table" row -->
							<xsl:text disable-output-escaping="yes">
								&lt;div class="spEntriesListRow" &gt;
							</xsl:text>
						</xsl:if>
						<div style="width: {$eCellWidth}%;">
							<xsl:attribute name="class">
								<xsl:choose>
									<xsl:when test="( ( position() - 1 ) mod $entriesInLine ) ">spEntriesListCell spEntriesListRightCell</xsl:when>
									<xsl:otherwise>spEntriesListCell</xsl:otherwise>
								</xsl:choose>
							</xsl:attribute>
							<xsl:call-template name="vcard" />
						</div>
						<xsl:if test="$entriesInLine > 1 and ( ( position() mod $entriesInLine ) = 0 or position() = $entriesCount )">
							<div style="clear:both"></div>
							<!-- closing the "table" row -->
							<xsl:text disable-output-escaping="yes">
								&lt;/div&gt;
							</xsl:text>
						</xsl:if>
				
					</div>
				</div>
				
			</div>
			</li>
		</xsl:for-each> 
		</ul>
		<div class="page_navigation"></div>
	</div>
	</div>
	<div style="clear:both;"/>
	</xsl:template>
</xsl:stylesheet>
