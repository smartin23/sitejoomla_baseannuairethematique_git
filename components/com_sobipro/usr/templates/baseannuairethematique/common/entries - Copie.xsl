<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:php="http://php.net/xsl">
<xsl:output method="xml" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" encoding="UTF-8"/>
<xsl:include href="vcard.xsl" />

	<xsl:template name="entriesLoop">
	<div class="spEntriesListContainer">
	
	<div id="entriescarousel" class="carousel slide">
	<div class="carousel-inner">
		<xsl:variable name="entriesInLine">
			<xsl:value-of select="entries_in_line" />
		</xsl:variable>
		<xsl:variable name="eCellWidth">
			<xsl:value-of select="(100 div $entriesInLine) -5" />
		</xsl:variable>
		<xsl:variable name="entriesCount">
			<xsl:value-of select="count(entries/entry)" />
		</xsl:variable>

		<xsl:for-each select="entries/entry">
	
		<div>
			<xsl:attribute name="class">
				<xsl:choose>
					<xsl:when test="position() = 1 and $entriesInLine &gt; 0">item active</xsl:when>
					<xsl:otherwise>item</xsl:otherwise>
				</xsl:choose>
			</xsl:attribute>
		</div>	
		
		<div class="item">
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
		</xsl:for-each>
	</div>
	 <a class="carousel-control left" href="#entriescarousel" data-slide="prev"><i class="icon-circle-arrow-left icon-large"></i></a>
     <a class="carousel-control right" href="#entriescarousel" data-slide="next"><i class="icon-circle-arrow-right icon-large"></i></a>
	</div>
	</div>
	<div style="clear:both;"/>
	</xsl:template>
</xsl:stylesheet>
